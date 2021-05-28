<?php


namespace App\Shared\Infrastructure\Symfony;


final class MetaResponse
{
    private int $currentPage;
    private int $nextPage;
    private int $prevPage;
    private int $pagesCount;
    private int $totalItems;

    public function __construct(?int $currentPage,  int $pagesCount, int $totalItems)
    {
        $this->currentPage = null === $currentPage ? 1 : $currentPage;
        $this->nextPage = $this->currentPage >= $pagesCount ? $pagesCount : $this->currentPage + 1;
        $this->prevPage = $this->currentPage - 1 > 0 ? $this->currentPage -1 : 1;
        $this->pagesCount = $pagesCount;
        $this->totalItems = $totalItems;
    }

    public static function toPrimitives(int $currentPage, int $pagesCount, int $totalItems): array
    {
        $meta = new self($currentPage, $pagesCount, $totalItems);

        return [
            'currentPage' => $meta->currentPage(),
            'prevPage' => $meta->prevPage(),
            'nextPage' => $meta->nextPage(),
            'pagesCount' => $meta->pagesCount(),
            'totalItems' => $meta->totalItems()
        ];
    }

    public function currentPage(): int
    {
        return $this->currentPage;
    }


    public function nextPage(): int
    {
        return $this->nextPage;
    }


    public function prevPage(): int
    {
        return $this->prevPage;
    }

    public function pagesCount(): int
    {
        return $this->pagesCount;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }


}