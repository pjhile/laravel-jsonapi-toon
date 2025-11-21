<?php

namespace Pjhile\JsonApiToon\Http\Responses;

use CloudCreativity\LaravelJsonApi\Http\Responses\AbstractResponder;
use HelgeSverre\Toon\Toon;

class ToonResponder extends AbstractResponder
{
    public function respond()
    {
        $document = $this->encoder()->encode($this->resource);

        $toon = Toon::encode($this->resourceToArray($document), [
            'indent'    => config('json-api-toon.indent', '  '),
            'delimiter' => config('json-api-toon.delimiter', ','),
        ]);

        return response($toon, $this->statusCode, array_merge(
            $this->headers,
            ['Content-Type' => config('json-api-toon.media-type', 'application/toon')]
        ));
    }

    protected function resourceToArray($resource): array
    {
        return is_array($resource) ? $resource : json_decode(json_encode($resource), true);
    }
}
