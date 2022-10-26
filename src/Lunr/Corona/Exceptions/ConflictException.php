<?php
/**
 * This file contains the ConflictException class.
 *
 * @package   Lunr\Corona\Exceptions
 * @author    Damien Tardy-Panis <damien@m2mobi.com>
 * @copyright 2018, M2Mobi BV, Amsterdam, The Netherlands
 * @license   http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Corona\Exceptions;

use Lunr\Corona\HttpCode;
use Exception;

/**
 * Exception for the Conflict HTTP error (409).
 */
class ConflictException extends HttpException
{

    /**
     * Constructor.
     *
     * @param string|null    $message  Error message
     * @param int            $app_code Application error code
     * @param Exception|null $previous The previously thrown exception
     */
    public function __construct(?string $message = NULL, int $app_code = 0, Exception $previous = NULL)
    {
        parent::__construct($message, HttpCode::CONFLICT, $app_code, $previous);
    }

}

?>
