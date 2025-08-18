@field(array_merge([
    'id'   => $field['name'],
    'type' => $field['type'],
    'name' => $field['name'],
    'label' => $field['label'],
    'required' => $field['required'],
    'icon' => $field['icon'] ?? '',
    'prefix' => $field['prefix'] ?? '',
    'suffix' => $field['suffix'] ?? '',
    'helperText' => $field['description'] ?? '',
    'placeholder' => $field['placeholder'] ?? '',
    'datalist' => $field['datalist'] ?? null,
    'fieldAttributeList' => [
        'data-source' => !empty($field['dataSource']) ? json_encode($field['dataSource']) : null,
    ],
], !empty($field['props']) ? (array) $field['props'] : []))
@endfield
