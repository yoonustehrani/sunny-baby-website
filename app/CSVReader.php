<?php

namespace App;

use Exception;

class CSVReader
{
    public $stream;
    protected $size;
    protected $data_types;
    protected $data;

    public function __construct(string $path, array $data_types)
    {
        $this->stream = fopen($path, 'r');
        $this->size = filesize($path);
        $this->data_types = $data_types;
    }

    public function read()
    {
        if ($this->data_types == null) {
            throw new Exception("Please provide datatypes using setDataTypes method");
        }
        $this->data = [];
        try {
            $headers = [];
            $row = 1;
            while (($data = fgetcsv($this->stream, $this->size)) !== FALSE) {
                if ($row == 1) {
                    $headers = $data;
                } else {
                    $data = array_map(function($value, $type) {
                        if (is_null($value)) {
                            return null;
                        }
                        if (empty($value) && $type == 'int') {
                            return null;
                        }
                        if (enum_exists($type)) {
                            return $type::tryFrom($value);
                        }
                        return match ($type) {
                            'quote', 'q' => unquote_str($value),
                            'str', 'string' => preg_replace('/[\p{C}]/u', '', $value),
                            'int', 'integer' => intval($value),
                            'bool', 'boolean' => filter_var($value, FILTER_VALIDATE_BOOL),
                            default => $value
                        };
                    }, $data, $this->data_types);
                    $this->data[] = array_combine($headers, $data);
                }
                $row++;
            }
            fclose($this->stream);
        } catch (\Throwable $th) {
            fclose($this->stream);
        }
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __destruct()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
}
