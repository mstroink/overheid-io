<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Http\Adapter\Guzzle\Exception;

use MStroink\OverheidIo\Exception\{UnauthorizedException, NotFoundException, OverheidIoException};
use GuzzleHttp\Exception\TransferException;

final class ExceptionHandler
{
    public static function handleRequestException(TransferException $exception): void
    {
        switch ($exception->getCode()) {
            case 404:
                throw new NotFoundException('Not Found', 404, $exception);
            case 401:
                throw new UnauthorizedException('Unauthorized', 401, $exception);
            case 500: //unfortunately overheid.io returns 500 when a resource is not found
                throw new NotFoundException('Not Found', 404, $exception);
        }

        throw new OverheidIoException($exception->getMessage());
    }
}
