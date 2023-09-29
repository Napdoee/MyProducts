<!-- Libs JS -->
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js?1684106062') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') }} " defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js?1684106062') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('dist/js/tabler.min.js?1684106062') }}" defer></script>
<script src="{{ asset('dist/js/demo.min.js?1684106062') }}" defer></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script> -->

<script type="text/javascript">
	$('#example').DataTable();
	$('#example_length').css('padding', '15px 15px 0px');
	$('#example_filter').css('padding', '15px 15px 0px');
	$('#example_info').css('padding', '20px 15px');
	$('#example_paginate').css('padding', '15px');
</script>

<!-- <script>
	document.querySelector("input[type-currency='IDR']").foreach((element) => {
		element.addEventListener('keyup', function(e) {
			let cursorPosition = this.selectionStart;
			let value = parseInt(this.value.replace(/[^,\d]/g, ''));
			let originalLength = this.value.length;

			if(isNan(value)) {
				this.value = '';
			} else {
				this.value = value.toLocaleString('id-ID', {
					currency: 'IDR',
					style: 'currency',
					minimunFractionDigits: 0
				});
				cursorPosition = $this.value.length - originalLength + cursorPosition;
				this.setSelectionRange(cursorPosition, cursorPosition);
			}
		})
	})
    </script> -->