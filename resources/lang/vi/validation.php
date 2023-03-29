<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Trường :attribute phải được chấp nhận.',
    'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'                => 'Trường :attribute phải là một ngày sau :date.',
    'after_or_equal'       => 'Trường :attribute phải là một ngày sau hoặc bằng :date.',
    'alpha'                => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num'            => 'Trường :attribute chỉ có thể chứa các chữ cái và số.',
    'array'                => 'Trường :attribute phải là một mảng.',
    'before'               => 'Trường :attribute phải là một ngày trước :date.',
    'before_or_equal'      => 'Trường :attribute phải là một ngày trước hoặc bằng :date.',
    'between'              => [
        'numeric'               => 'Trường :attribute phải nằm giữa :min và :max.',
        'file'                  => 'Trường :attribute phải nằm trong khoảng :min và :max kilobyte.',
        'string'                => 'Trường :attribute phải nằm giữa :min và :max ký tự.',
        'array'                 => 'Trường :attribute phải có các mục từ :min đến :max.',
    ],
    
    
    
    
    
    
    
    
    
    
    'boolean'              => 'Trường :attribute phải đúng hoặc sai.',
    'confirmed'            => 'Trường :attribute nhận đinh không phù hợp.',
    'date'                 => 'Trường :attribute Không phải là ngày hợp lệ.',
    'date_format'          => 'Trường :attribute không khớp với định dạng :format.',
    'different'            => 'Trường :attribute và : other phải khác.',
    'digits'               => 'Trường :attribute phải là :digits chữ số.',
    'digits_between'       => 'Trường :attribute phải nằm giữa các chữ số :min và :max.',
    'dimensions'           => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct'             => 'Trường :attribute có giá trị trùng lặp.',
    'email'                => 'Trường :attribute phải la một địa chỉ email hợp lệ.',
    'exists'               => 'Trường :attribute đã chọn không hợp lệ.',
    'file'                 => 'Trường :attribute phải là một tập tin.',
    'filled'               => 'Trường :attribute phải có một giá trị.',
    'gt'                   => [
        'numeric'               => 'Trường :attribute phải lớn hơn :value.',
        'file'                  => 'Trường :attribute phải lớn hơn :value kilobytes.',
        'string'                => 'Trường :attribute phải lớn hơn :value ký tự.',
        'array'                 => 'Trường :attribute phải có nhiều hơn :value các mục.',
    ],
    'gte'                  => [
        'numeric'               => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'file'                  => 'Trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string'                => 'Trường :attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array'                 => 'Trường :attribute phải có :value mục trở lên.',
    ],
    'image'                => 'Trường :attribute phải là một hình ảnh.',
    'in'                   => 'Trường :attribute đã chọn không hợp lệ.',
    'in_array'             => 'Trường :attribute không tồn tại trong :other.',
    'integer'              => 'Trường :attribute phải là số nguyên.',
    'ip'                   => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4'                 => 'Trường :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6'                 => 'Trường :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json'                 => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'lt'                   => [
        'numeric'               => 'Trường :attribute phải lớn hơn :value.',
        'file'                  => 'Trường :attribute phải lớn hơn :value kilobytes.',
        'string'                => 'Trường :attribute phải lớn hơn :value ký tự.',
        'array'                 => 'Trường :attribute phải có nhiều hơn :value các mục.',
    ],
    'lte'                  => [
        'numeric'               => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'file'                  => 'Trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string'                => 'Trường :attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array'                 => 'Trường :attribute phải có :value mục trở lên.',
    ],
    'max'                  => [
        'numeric'               => 'Trường :attribute không được lớn hơn :max.',
        'file'                  => 'Trường :attribute có thể không lớn hơn :kilobyte tối đa.',
        'string'                => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array'                 => 'Trường :attribute có thể không có nhiều hơn :max mục.',
    ],
    'mimes'                => 'Trường :attribute phải là một tệp loại: :values.',
    'mimetypes'            => 'Trường :attribute phải là một tệp loại: :values.',
    'min'                  => [
        'numeric'               => 'Trường :attribute ít nhất phải là :min.',
        'file'                  => 'Trường :attribute phải ít nhất là :min kilobyte.',
        'string'                => 'Trường :attribute phải có ít nhất :minký tự .',
        'array'                 => 'Trường :attribute phải có ít nhất :min item.',
    ],
    'not_in'               => 'Trường :attribute đã chọn không hợp lệ.',
    'not_regex'            => 'Trường :attribute định dạng không hợp lệ.',
    'numeric'              => 'Trường :attribute phải là một số.',
    'present'              => 'Trường :attribute phải có mặt.',
    'regex'                => 'Trường :attribute định dạng không hợp lệ.',
    'required'             => 'Trường :attribute lĩnh vực được yêu cầu.',
    'required_if'          => 'Trường :attribute được yêu cầu khi :other là :value.',
    'required_unless'      => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with'        => 'Trường :attribute được yêu cầu khi có :values.',
    'required_with_all'    => 'Trường :attribute được yêu cầu khi có :values.',
    'required_without'     => 'Trường :attribute được yêu cầu khi :values không có mặt.',
    'required_without_all' => 'Trường :attribute được yêu cầu khi không có :giá trị nào hiện diện.',
    'same'                 => 'Trường :attribute và :other phải khớp.',
    'size'                 => [
        'numeric'               => 'Trường :attribute phải là :size.',
        'file'                  => 'Trường :attribute phải là :size kilobyte.',
        'string'                => 'Trường :attribute phải là :size ký tự.',
        'array'                 => 'Trường :attribute phải chứa các mục :size.',
    ],
    'string'               => 'Trường :attribute phải là một chuỗi.',
    'timezone'             => 'Trường :attribute phải là một vùng hợp lệ.',
    'unique'               => 'Trường :attribute đã được thực hiện.',
    'uploaded'             => 'Trường :attribute không thể tải lên.',
    'url'                  => 'Trường :attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
