@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<page-navbar
    link="/"
    brand="Medicine"
    title="IPD Note"
    an-pattern="^[0-9]{8}$"
    username="{{ auth()->user()->name }}">
</page-navbar>

<!-- <pagination
    pages-count="13">
</pagination> -->
<data-sheet
    pages-count=20>
</data-sheet>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
<script>
    function pagination(currentPage, nrOfPages) {
        var delta = 2,
            range = [],
            rangeWithDots = [],
            l;

        range.push(1);

        if (nrOfPages <= 1){
        return range;
        }

        for (let i = currentPage - delta; i <= currentPage + delta; i++) {
            if (i < nrOfPages && i > 1) {
                range.push(i);
            }
        }
        range.push(nrOfPages);

        for (let i of range) {
            if (l) {
                if (i - l === 2) {
                    rangeWithDots.push(l + 1);
                } else if (i - l !== 1) {
                    rangeWithDots.push('...');
                }
            }
            rangeWithDots.push(i);
            l = i;
        }

        return rangeWithDots;
    }
</script>
@endsection
