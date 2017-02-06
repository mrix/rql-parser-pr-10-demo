<?php
namespace MyRqlParserEx;

use Xiag\Rql\Parser\SubLexerChain;

class Lexer extends \Xiag\Rql\Parser\Lexer
{
    /**
     * @inheritdoc
     */
    public static function createDefaultSubLexer()
    {
        $chainSubLexer = (new SubLexerChain())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\ConstantSubLexer())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\PunctuationSubLexer())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\FiqlOperatorSubLexer())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\RqlOperatorSubLexer())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\TypeSubLexer())

            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\DatetimeSubLexer())

            // override only these lexers
            ->addSubLexer(new SubLexer\GlobSubLexer())
            ->addSubLexer(new SubLexer\StringLikeSubLexer())

            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\NumberSubLexer())
            ->addSubLexer(new \Xiag\Rql\Parser\SubLexer\SortSubLexer());

        // allow to use leading spaces
        return new SubLexer\SpaceSubLexer($chainSubLexer);
    }
}
