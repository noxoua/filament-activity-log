<?php

namespace Noxo\FilamentActivityLog\Extensions;

use Filament\Actions as PageActions;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions as TableActions;

class LogActions
{
    use Concerns\HasCreated;
    use Concerns\HasDeleted;
    use Concerns\HasRestored;
    use Concerns\HasUpdated;

    public static function mount(): void
    {
        $self = new static;

        // * Table Actions
        // TableActions\AssociateAction::configureUsing(fn ($action) => $self->associate($action));
        // TableActions\AttachAction::configureUsing(fn ($action) => $self->attach($action));
        TableActions\CreateAction::configureUsing(fn ($action) => $self->create($action));
        TableActions\DeleteAction::configureUsing(fn ($action) => $self->delete($action));
        // TableActions\DetachAction::configureUsing(fn ($action) => $self->detach($action));
        // TableActions\DissociateAction::configureUsing(fn ($action) => $self->dissociate($action));
        TableActions\EditAction::configureUsing(fn ($action) => $self->edit($action));
        TableActions\ForceDeleteAction::configureUsing(fn ($action) => $self->delete($action));
        TableActions\ReplicateAction::configureUsing(fn ($action) => $self->create($action));
        TableActions\RestoreAction::configureUsing(fn ($action) => $self->restore($action));

        // * Page Actions
        PageActions\CreateAction::configureUsing(fn ($action) => $self->create($action));
        PageActions\DeleteAction::configureUsing(fn ($action) => $self->delete($action));
        PageActions\EditAction::configureUsing(fn ($action) => $self->edit($action));
        PageActions\ForceDeleteAction::configureUsing(fn ($action) => $self->delete($action));
        PageActions\ReplicateAction::configureUsing(fn ($action) => $self->create($action));
        PageActions\RestoreAction::configureUsing(fn ($action) => $self->restore($action));
    }

    public function create($action): void
    {
        $action->after(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerCreated($livewire, $record)
                : $this->logRecordCreated($record);
        });
    }

    public function delete($action): void
    {
        $action->before(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerDeleted($livewire, $record)
                : $this->logRecordDeleted($record);
        });
    }

    public function edit($action): void
    {
        $action->beforeFormValidated(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerBefore($livewire, $record)
                : $this->logRecordBefore($record);
        });

        $action->after(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerAfter($livewire, $record)
                : $this->logRecordAfter($record);
        });
    }

    public function restore($action): void
    {
        $action->after(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerRestored($livewire, $record)
                : $this->logRecordRestored($record);
        });
    }
}
