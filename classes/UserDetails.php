<?php
class UserDetails
{
    public function store_post($fields = array())
    {
        $res = array();
        foreach ($fields as $name => $value) {
            $res[$name] = $value;
        }
        return $res;
    }
}
