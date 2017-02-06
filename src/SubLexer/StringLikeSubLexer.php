<?php
namespace MyRqlParserEx\SubLexer;

use Xiag\Rql\Parser\Token;
use Xiag\Rql\Parser\SubLexerInterface;

class StringLikeSubLexer implements SubLexerInterface
{
    /**
     * @inheritdoc
     */
    public function getTokenAt($code, $cursor)
    {
        $regExp = '/(?:[a-z0-9_\.]|\%[0-9a-f]{2})+(?:[a-z0-9_\.]|\%[0-9a-f]{2}|[+-])*/Ai';
        if (!preg_match($regExp, $code, $matches, null, $cursor)) {
            return null;
        } elseif (is_numeric($matches[0])) {
            // NOTE: this case will be handled via NumberSubLexer
            return null;
        }

        return new Token(
            Token::T_STRING,
            rawurldecode($matches[0]),
            $cursor,
            $cursor + strlen($matches[0])
        );
    }
}
