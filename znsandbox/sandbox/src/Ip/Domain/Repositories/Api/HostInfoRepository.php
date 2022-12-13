<?php

namespace ZnSandbox\Sandbox\Ip\Domain\Repositories\Api;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use ZnSandbox\Sandbox\Ip\Domain\Helpers\IpHelper;
use ZnSandbox\Sandbox\Ip\Domain\Interfaces\Repositories\HostInfoRepositoryInterface;

class HostInfoRepository implements HostInfoRepositoryInterface
{

    private $cache;

    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
        //dd($cache);
    }

    public function getIpByDomainList(array $domains)
    {
        $collection = [];
        foreach ($domains as $domain) {
            $collection[$domain] = $this->getIpByDomain($domain);
        }
        return $collection;
    }

    public function getIpByDomain(string $domain)
    {
        $cacheItem = $this->cache->getItem('getIpByDomain.' . $domain);
        if($cacheItem->get() === null) {
            $item = [
                'domain' => $domain,
                'ip' => [],
            ];
//        $domain = self::cleanUrl($domain);
            $url = parse_url($domain);
            if(empty($ipList)) {
                $url = parse_url('https://' . $domain);
            }
            $ipList = gethostbynamel($url['host']);

            if(is_array($ipList)) {
                foreach($ipList as $ip) {
                    $item['ip'][] = $ip;
                }
            }

            $cacheItem->set($item);
            $this->cache->save($cacheItem);
        }
        return $cacheItem->get();
    }

    public function getHostInfo($ip) {
        $cacheItem = $this->cache->getItem('getHostInfo.' . $ip);
        if($cacheItem->get() === null) {
            $xml = simplexml_load_string(file_get_contents('http://rest.db.ripe.net/search?query-string=' . $ip));
            $array = json_decode(json_encode($xml), TRUE);
            $data = array();
            foreach ($array['objects'] as $row) {
                foreach ($row as $row2) {
                    foreach ($row2['attributes'] as $row3) {
                        foreach ($row3 as $row4) {
                            $data[$row4['@attributes']['name']][] = $row4['@attributes']['value'];
                        }
                    }
                }
            }
            $cacheItem->set($data);
            $this->cache->save($cacheItem);
        }

        return $cacheItem->get();
    }
}
