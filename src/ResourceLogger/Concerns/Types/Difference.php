<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

trait Difference
{
    /**
     * @see https://www.npmjs.com/package/diff
     */
    public function difference(string $method = 'diffWords', array $options = []): static
    {
        $methods = [
            'diffChars',
            'diffWords',
            'diffWordsWithSpace',
            'diffLines',
            'diffTrimmedLines',
            'diffSentences',
            'diffCss',
            'diffJson',
            'diffArrays',
        ];

        if (! in_array($method, $methods)) {
            $method = 'diffWords';
        }

        $this->type('difference', compact('method', 'options'));

        $this->formatStateUsing(function ($state) {
            if (is_null($state)) {
                $state = '';
            }

            // TODO: not working with array
            // * resources/views/components/difference.blade.php
            return json_encode($state);
        });

        return $this;
    }
}
