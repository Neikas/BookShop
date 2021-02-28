
<reviews-index :book=" {{ json_encode($book) }}"  :login="{{ auth()->check() ? 1 : 0 }}"></reviews-index>

