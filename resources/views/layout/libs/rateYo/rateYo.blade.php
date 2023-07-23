<link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/rateyo/jquery.rateyo.min.css">
<script src="{{ asset('assets') }}/vendor/libs/rateyo/jquery.rateyo.min.js"></script>

<script>
    function customerSingleStarRating(customer_id, average_rating) {
        console.log(customer_id, average_rating);
        console.log($("#read-only-ratings_" + customer_id))
        $("#read-only-ratings_" + customer_id).rateYo({
            rating: average_rating,
            maxValue: 5,
            readOnly: true,
            starWidth: "25px",
            numStars: 1,
            ratedFill: "#7367f0",
        });
    }
</script>
