<?php


namespace Discord\Application\Service\Message;


use Discord\Domain\Model\Message\Message;

class MessageCommandFactory
{

    /**
     * @param $commandSymbol
     * @param Message $message
     *
     * @return MessageCommand|null
     */
    public static function fromMessage($commandSymbol, Message $message)
    {
        return static::fromString($commandSymbol, $message->getContent());
    }

    /**
     * @param $commandSymbol
     * @param $string
     *
     * @return MessageCommand|null
     */
    public static function fromString($commandSymbol, $string)
    {
        if (strlen($string) === 0) {
            return null;
        }

        $string = static::sanitizeCommand($string);

        // check if message is command
        if (!preg_match('/^' . $commandSymbol . '.+$/', $string)) {
            return null;
        }

        // remove command symbol
        $string = substr($string, 1);

        // get command with arguments in array
        $exploded = explode(' ', $string);

        if (count($exploded) < 1) {
            return null;
        }

        // get command and remove it from stack
        $command = array_shift($exploded);

        return new MessageCommand($commandSymbol, $command, $exploded);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private static function sanitizeCommand($string)
    {
        return trim(filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    }
}