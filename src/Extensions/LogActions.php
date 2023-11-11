<?php

namespace Noxo\FilamentActivityLog\Extensions;

use Closure;
use Filament\Actions as PageActions;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions as TableActions;
use Filament\Tables\Columns;

class LogActions
{
    use Concerns\HasCreated;
    use Concerns\HasDeleted;
    use Concerns\HasRestored;
    use Concerns\HasUpdated;

    public array $targets = [
        // * ----------- Table Actions -----------
        // TableActions\AssociateAction::class => 'associate',
        // TableActions\AttachAction::class => 'attach',
        TableActions\CreateAction::class => 'create',
        TableActions\DeleteAction::class => 'delete',
        // TableActions\DeleteBulkAction::class => 'delete',
        // TableActions\DetachAction::class => 'detach',
        // TableActions\DetachBulkAction::class => 'detach',
        // TableActions\DissociateAction::class => 'dissociate',
        // TableActions\DissociateBulkAction::class => 'dissociate',
        TableActions\EditAction::class => 'edit',
        TableActions\ForceDeleteAction::class => 'delete',
        // TableActions\ForceDeleteBulkAction::class => 'delete',
        TableActions\ReplicateAction::class => 'create',
        TableActions\RestoreAction::class => 'restore',
        // TableActions\RestoreBulkAction::class => 'restore',

        // * ----------- Page Actions -----------
        PageActions\CreateAction::class => 'create',
        PageActions\DeleteAction::class => 'delete',
        PageActions\EditAction::class => 'edit',
        PageActions\ForceDeleteAction::class => 'delete',
        PageActions\ReplicateAction::class => 'create',
        PageActions\RestoreAction::class => 'restore',

        // * ----------- Editable Columns -----------
        Columns\CheckboxColumn::class => 'editableColumn',
        Columns\SelectColumn::class => 'editableColumn',
        Columns\TextInputColumn::class => 'editableColumn',
        Columns\ToggleColumn::class => 'editableColumn',
    ];

    public function configure(): void
    {
        foreach ($this->targets as $class => $action) {
            $class::configureUsing(Closure::fromCallable([$this, $action]));
        }
    }

    public function editableColumn($column): void
    {
        $column->beforeStateUpdated(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerBefore($livewire, $record)
                : $this->logRecordBefore($record);
        });

        $column->afterStateUpdated(function ($livewire, $record): void {
            $livewire instanceof RelationManager
                ? $this->logManagerAfter($livewire, $record)
                : $this->logRecordAfter($record);
        });
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
