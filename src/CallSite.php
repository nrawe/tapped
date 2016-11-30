<?php

namespace Rawebone\Tapped;

/**
 * CallSite provides information about the location that a call in the stack
 * came from.
 *
 * This simple utility can then be used to provide greater diagnostic data to
 * the person debugging the failing test.
 */
class CallSite
{
    /**
     * The file the call originated in.
     *
     * @var string
     */
    protected $file;
    
    /**
     * The line the call started on.
     *
     * @var int
     */
    protected $line;

    public function __construct(int $calls)
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $calls + 1);

        $this->file = $trace[$calls]['file'];
        $this->line = $trace[$calls]['line'];
    }

    public function file(): string
    {
        return $this->file;
    }

    public function line(): int
    {
        return $this->line;
    }
}
