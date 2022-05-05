<?php

namespace App\Parcer;

use App\Parcer\Interfaces\ParcerStrategyInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Realiastion of Strategy Pattern
 */
class ParcerManager
{
    private $domain;
    private $parceStrategy;

    /**
     * @param string $domain
     */
    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function handle(): array
    {
        return $this->parceSiteByDomain();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    private function parceSiteByDomain()
    {
        $strategy = $this->getStrategyByDomain();

        return $this->setParceStrategy($strategy)->parceData();
    }


    /**
     * @return ParcerStrategyInterface
     * @throws \Exception
     */
    private function getStrategyByDomain(): ParcerStrategyInterface
    {
        $strategyClass = __NAMESPACE__ . '\\Strategies\\' . ucwords($this->domain) . 'Strategy';

        if (!class_exists($strategyClass)) {
            throw new Exception("Strategy class not found [{$strategyClass}]");
        }

        return new $strategyClass;
    }

    /**
     * @param ParcerStrategyInterface $strategy
     * @return $this
     */
    private function setParceStrategy(ParcerStrategyInterface $strategy)
    {
        $this->parceStrategy = $strategy;

        return $this;
    }

    /**
     * @return array
     */
    private function parceData(): array
    {
        return $this->parceStrategy->run();
    }

}
