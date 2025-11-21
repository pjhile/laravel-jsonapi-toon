<?php

namespace Pjhile\JsonApiToon\Encodings;

use LaravelJsonApi\Core\Document\EncodesResource;
use LaravelJsonApi\Encoder\Neomerx\Encoder;
use HelgeSverre\Toon\Toon;

class ToonEncoding implements EncodesResource
{
    public function encode($resource): string
    {
        $encoder = Encoder::instance();
        $json = $encoder->encodeData($resource);

        return Toon::encode($json, [
            'indent'    => config('json-api-toon.indent', '  '),
            'delimiter' => config('json-api-toon.delimiter', ','),
        ]);
    }

    public function contentType(): string
    {
        return config('json-api-toon.media-type', 'application/toon');
    }
}
