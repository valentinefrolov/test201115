<?php

class Author {
    /** @var Article[]  */
    private $articles = [];

    /**
     * @param string $subject
     * @param string $content
     * @return Article
     */
    public function createArticle(string $subject, string $content) : Article {
        $article = new Article($this, $subject, $content);
        $this->articles[] = $article;
        return $article;
    }

    /**
     * @return Article[]
     */
    public function getArticles() : array {
        return $this->articles;
    }
}


class Article {
    /** @var string  */
    private $subject = '';
    /** @var string  */
    private $content = '';
    /** @var Author  */
    private $author = null;

    /**
     * Article constructor.
     * @param Author $author
     * @param string $subject
     * @param string $content
     */
    public function __construct(Author $author, string $subject, string $content) {
        $this->author = $author;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return Author
     */
    public function getAuthor() : Author {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function changeAuthor(Author $author) : void {
        $this->author = $author;
    }
}
