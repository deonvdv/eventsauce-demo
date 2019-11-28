<?php

namespace Todos\Decorator;

use EventSauce\EventSourcing\Message;
use Jaeger\Propagator\JaegerPropagator;
use EventSauce\EventSourcing\MessageDecorator;

class ContextDecorator implements MessageDecorator
{
    public function decorate(Message $message): Message
    {
        // $spanContext = app('context.tracer.activeSpan')->getContext();

        // return $message->withHeader('tracing_context', [
        //     'parent_id' => $spanContext->parentIdToString(),
        //     'span_id' => $spanContext->spanIdToString(),
        // ]);

        $jeager = [];

        // Inject Jeager trace header
        (new JaegerPropagator)->inject(app('context.tracer.activeSpan')->getContext(), '', $jeager);

        // dump(array_key_first($jeager));
        // dump($jeager[array_key_first($jeager)]);
        return $message->withHeader(
            array_key_first($jeager),
            $jeager[array_key_first($jeager)]
        );
    }
}
