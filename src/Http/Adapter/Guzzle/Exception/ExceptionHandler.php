<?php
declare(strict_types=1);

namespace MStroink\OverheidIo\Http\Adapter\Guzzle\Exception;

use MStroink\OverheidIo\Exception\UnauthorizedException;
use MStroink\OverheidIo\Exception\NotFoundException;
use MStroink\OverheidIo\Exception\ServerException;
use MStroink\OverheidIo\Exception\UnknownException;
use GuzzleHttp\Exception\TransferException;

final class ExceptionHandler
{
    public static function handleRequestException(TransferException $exception): void
    {
        $statusCode = $exception->getCode();
        switch ($statusCode) {
            case 404:
                throw new NotFoundException('Not Found', 404, $exception);
            case 401:
                throw new UnauthorizedException('Unauthorized', 401, $exception);
            case 500 <= $statusCode:
                throw new ServerException('An unexpected error occurred', $statusCode, $exception);
            default:
                throw new UnknownException('Unkown server error', $statusCode, $exception);
        }
    }
}
