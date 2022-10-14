<?php

declare(strict_types = 1);

namespace OxidSupport\Command;

use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;

class Counter
{
    private QueryBuilderFactoryInterface $queryBuilderFactory;

    public function __construct(QueryBuilderFactoryInterface $queryBuilderFactory)
    {
        $this->queryBuilderFactory = $queryBuilderFactory;
    }

    public function count()
    {
        $product = oxNew(Article::class);
        $tableViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $viewName = $tableViewNameGenerator->getViewName($product->getCoreTableName());

        $queryBuilder = $this->queryBuilderFactory->create();
        $queryBuilder
            ->select('COUNT(OXID) AS count')
            ->from($viewName)
            ->where($product->getSqlActiveSnippet());

        $result = $queryBuilder->execute();
        $numberOfProducts = $result->fetchAssociative();
        
        return $numberOfProducts['count'];
    }
}