<?php
namespace MyRqlParserEx\SubLexer;

use Xiag\Rql\Parser\SubLexerInterface;

class SpaceSubLexer implements SubLexerInterface
{
    /**
     * @var SubLexerInterface
     */
    private $subLexer;

    /**
     * @param SubLexerInterface $subLexer
     */
    public function __construct(SubLexerInterface $subLexer)
    {
        $this->subLexer = $subLexer;
    }

    /**
     * @inheritdoc
     */
    public function getTokenAt($code, $cursor)
    {
        if (preg_match('/ +/A', $code, $matches, null, $cursor)) {
            $offset = strlen($matches[0]);
        } else {
            $offset = 0;
        }

        return $this->subLexer->getTokenAt($code, $cursor + $offset);
    }
}
