@php
    $ajaxretrieve = User::whereHas('rights', function($query) {
            $query->where('id', $selectedright);
        })->get();
        return $ajaxretrieve;
@endphp
