<?php


namespace Discord\Application\Service;


interface ApplicationService
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute($request = null);
}