<?php

namespace Untek\Bundle\Queue\Domain\Queries;

use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Query\Entities\Where;
use Untek\Lib\Components\Status\Enums\StatusEnum;

class NewTaskQuery extends Query //TaskOrderQuery
{

    public function __construct(string $channel = null)
    {
        $this->limit(20);
        $this->addOrder();
        $this->addStatusFilter();
        if ($channel) {
            $this->addChannelFilter($channel);
        }
    }

    private function addOrder()
    {
        $this->orderBy([
            'priority' => SORT_DESC,
            'pushed_at' => SORT_ASC,
        ]);
    }

    private function addStatusFilter()
    {
        $whereEnabled = new Where('status', StatusEnum::ENABLED);
        $this->whereNew($whereEnabled);
    }

    private function addChannelFilter(string $channel = null)
    {
        $whereChannel = new Where('channel', $channel);
        $this->whereNew($whereChannel);
    }
}
