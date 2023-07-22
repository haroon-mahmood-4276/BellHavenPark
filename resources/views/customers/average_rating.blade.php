<div class="d-flex flex-column justify-content-center align-items-center">
    <div id="read-only-ratings_{{ $customer->id }}"></div>
    <div>{{ number_format($customer->average_rating, 2) }}</div>
</div>

<script>
    rateYo({{ $customer->id }}, {{ $customer->average_rating }});
</script>
