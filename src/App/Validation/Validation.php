<?php

namespace App\Validation;

class Validation
{
    protected $messages = [];

    public function validate($request, $rules)
    {
        $data = $request->getQueryParams();

        foreach ($rules as $field => $rule)
        {
            if (empty($data[$field])) $data[$field] = null;

            $methods = explode('|', $rule);

            foreach ($methods as $method)
            {
                $this->$method(['name' => $field, 'value' => $data[$field]]);
            }
        }

        return;
    }

    public function required($field)
    {
        $validator = new \Zend\Validator\NotEmpty();

        if (! $validator->isValid($field['value']))
        {
            foreach ($validator->getMessages() as $message)
            {
                $this->messages[$field['name']][] = $message;
            }
        }

        return;
    }
    
    public function alnum($field)
    {
        $pattern = '/^[0-9A-Za-z\s\-]+$/';
        $validator = new \Zend\Validator\Regex(['pattern' => $pattern]);

        if (! $validator->isValid($field['value']))
        {
            foreach ($validator->getMessages() as $message)
            {
                $this->messages[$field['name']][] = $message;
            }
        }
        
        return;
    }
}
