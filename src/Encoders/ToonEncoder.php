<?php

namespace Pjhile\JsonApiToon\Encoders;

use LaravelJsonApi\Contracts\Encoder\Encoder as EncoderContract;
use HelgeSverre\Toon\Toon;

class ToonEncoder implements EncoderContract
{
    public function encode($resource): string
    {
        // The resource is already the full JSON:API document array
        return Toon::encode($resource, [
            'indent'    => config('json-api-toon.indent', '  '),
            'delimiter' => config('json-api-toon.delimiter', ','),
        ]);
    }

    public function contentType(): string
    {
        return config('json-api-toon.media-type', 'application/toon');
    }
}
