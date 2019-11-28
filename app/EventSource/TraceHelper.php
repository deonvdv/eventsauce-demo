<?php

namespace App\EventSource;

use Jaeger\Span;

class TraceHelper
{

    public static function trace(string $name, \Closure $callable, Span $parentSpan = null, array $tags = [])
    {
        // dd($parentSpan);
        // Get Tracer
        $tracer = app('context.tracer');

        if ($parentSpan == null) {
            // Start child span from GlobalSpan
            $span = $tracer->startSpan($name, ['child_of' => app('context.tracer.globalSpan')]);
        } else {
            // Start child span from parentSpan
            $span = $tracer->startSpan($name, ['child_of' => $parentSpan]);
        }
        // Set tags
        foreach ($tags as $tag => $value) {
            $span->setTag($tag, $value);
        }

        try {

            // Set ActiveSpan
            app()->instance('context.tracer.activeSpan', $span);

            return $callable($span);
        } finally {
            $span->finish();
        }
    }
}
