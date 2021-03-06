<?php


namespace Discord\Infrastructure\Websocket;


use Discord\Helper\ArrayAccessorTrait;


class Payload implements \JsonSerializable
{
    use ArrayAccessorTrait;

    public const EVENT = [
        // 	Receive	An event was dispatched.
        'DISPATCH' => 0,

        //	Send/Receive Fired periodically by the client to keep the connection alive.
        'HEARTBEAT' => 1,

        // 	Send Starts a new session during the initial handshake.
        'IDENTIFY' => 2,

        // 	Send Update the client's presence.
        'PRESENCE_UPDATE' => 3,

        //	Send Used to join/leave or move between voice channels.
        'VOICE_STATE_UPDATE' => 4,

        // Send	Resume a previous session that was disconnected.
        'RESUME' => 6,

        // Receive You should attempt to reconnect and resume immediately.
        'RECONNECT' => 7,

        // Send Request information about offline guild members in a large guild.
        'REQUEST_GUILD_MEMBERS' => 8,

        // Receive The session has been invalidated. You should reconnect and identify/resume accordingly.
        'INVALID_SESSION' => 9,

        // Receive	Sent immediately after connecting, contains the heartbeat_interval to use.
        'HELLO' => 10,

        // Receive	Sent in response to receiving a heartbeat to acknowledge that it has been received.
        'HEARTBEAT_ACK' => 11,
    ];

    /**
     * Opcode for the payload
     *
     * @var int
     */
    private $opCode;

    /**
     * Event data
     *
     * @var mixed
     */
    private $eventData;

    /**
     * Sequence number, used for resuming sessions and heartbeats
     *
     * @var int
     */
    private $sequenceNumber;

    /**
     * The event name for this payload
     *
     * @var string
     */
    private $eventName;

    /**
     * Payload constructor.
     *
     * @param int $opCode
     * @param $eventData
     * @param int $sequenceNumber
     * @param string $eventName
     */
    public function __construct(int $opCode, $eventData = null, int $sequenceNumber = null, string $eventName = null)
    {
        $this->opCode = $opCode;
        $this->eventData = $eventData;
        $this->sequenceNumber = $sequenceNumber;
        $this->eventName = $eventName;
    }

    /**
     * @return int
     */
    public function getOpCode(): ?int
    {
        return $this->opCode;
    }

    /**
     * @param int $opCode
     */
    public function setOpCode(int $opCode)
    {
        $this->opCode = $opCode;
    }

    /**
     * @param string|null $path
     *
     * @return mixed
     */
    public function getEventData(string $path = null)
    {
        if ($path === null) {
            return $this->eventData;
        }

        return $this->getValueByKey($this->eventData, $path);
    }

    /**
     * @param mixed $eventData
     */
    public function setEventData($eventData)
    {
        $this->eventData = $eventData;
    }

    /**
     * @return int
     */
    public function getSequenceNumber(): ?int
    {
        return $this->sequenceNumber;
    }

    /**
     * @param int $sequenceNumber
     */
    public function setSequenceNumber(int $sequenceNumber)
    {
        $this->sequenceNumber = $sequenceNumber;
    }

    /**
     * @return string
     */
    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     */
    public function setEventName(string $eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * Override to string method
     *
     * @return false|string
     */
    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * Implement jsonSerialize method
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'op' => $this->opCode,
            'd' => $this->eventData,
            's' => $this->sequenceNumber,
            't' => $this->eventName
        ];
    }

}