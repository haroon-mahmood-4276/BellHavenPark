@extends('reports.reports.layout')

@section('page-title', 'Daily Report')

@push('css')
@endpush

@section('content')
    <div class="text-center">
        <div class="block w-full bg-indigo-600 text-white font-bold text-5xl antialiased italic rounded-t-lg p-2">
            <h2>Bellhaven Carvan Park</h2>
        </div>

        <div class="block w-full font-bold text-3xl antialiased italic p-2">
            <h2>Daily Sales Report</h2>
        </div>

        <div class="block w-full font-bold border-t text-xl antialiased italic rounded-b-lg p-2 mb-3">
            <h2>Tudesday 16 April, 2024</h2>
        </div>

        <div class="mb-5">
            <table class="w-full">
                <tbody>
                    <tr class="border">
                        <th class="p-2 bg-indigo-400 text-white" colspan="11">EFTPOS</th>
                    </tr>
                    <tr class="border">
                        <th class="p-2 border-start-0 border-b">Trans No.</th>
                        <th class="p-2 border">Misc Trans No.</th>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Cabin No.</th>
                        <th class="p-2 border">Paid For</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Tax Rate %</th>
                        <th class="p-2 border">Taxable Amount</th>
                        <th class="p-2 border">GST</th>
                        <th class="p-2 border-end-0 border-b">GST Free</th>
                    </tr>
                    <tr class="border">
                        <td class="p-2 border-start-0 border-b">113344</td>
                        <td class="p-2 border"></td>
                        <td class="p-2 border">Haroon</td>
                        <td class="p-2 border">Mahmood</td>
                        <td class="p-2 border">Cabin 1</td>
                        <td class="p-2 border">Rent</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">10</td>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border-end-0 border-b">$0.00</td>
                    </tr>
                    <tr class="border-b-4 border">
                        <td class="p-2 border">113344</td>
                        <td class="p-2 border"></td>
                        <td class="p-2 border">Haroon</td>
                        <td class="p-2 border">Mahmood</td>
                        <td class="p-2 border">Cabin 1</td>
                        <td class="p-2 border">Rent</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">10</td>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>
                    <tr class="border">
                        <td class="p-2 border text-end" colspan="6">EFTPOS Totals</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">
                            </th>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>

                    <!-- Spacer -->
                    <tr>
                        <td class="p-2" colspan="11"></td>
                    </tr>

                    <!-- EFTPOS WESTPAC 284 -->
                    <tr class="border">
                        <th class="p-2 bg-indigo-400 text-white" colspan="11">EFTPOS WESTPAC 28</th>
                    </tr>
                    <tr class="border">
                        <th class="p-2 border-start-0 border-b">Trans No.</th>
                        <th class="p-2 border">Misc Trans No.</th>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Cabin No.</th>
                        <th class="p-2 border">Paid For</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Tax Rate %</th>
                        <th class="p-2 border">Taxable Amount</th>
                        <th class="p-2 border">GST</th>
                        <th class="p-2 border-end-0 border-b">GST Free</th>
                    </tr>
                    <tr class="border">
                        <td class="p-2 border-start-0 border-b">113344</td>
                        <td class="p-2 border"></td>
                        <td class="p-2 border">Haroon</td>
                        <td class="p-2 border">Mahmood</td>
                        <td class="p-2 border">Cabin 1</td>
                        <td class="p-2 border">Rent</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">10</td>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border-end-0 border-b">$0.00</td>
                    </tr>
                    <tr class="border-b-4 border">
                        <td class="p-2 border">113344</td>
                        <td class="p-2 border"></td>
                        <td class="p-2 border">Haroon</td>
                        <td class="p-2 border">Mahmood</td>
                        <td class="p-2 border">Cabin 1</td>
                        <td class="p-2 border">Rent</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">10</td>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>
                    <tr class="border">
                        <td class="p-2 border text-end" colspan="6">EFTPOS WESTPAC 28</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">
                            </th>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>

                    <!-- Spacer -->
                    <tr>
                        <td class="p-2" colspan="11"></td>
                    </tr>

                    <tr class="border">
                        <td class="p-2 border text-end" colspan="6">16 April, 2024 Totals</td>
                        <td class="p-2 border">$1100.00</td>
                        <td class="p-2 border">
                            </th>
                        <td class="p-2 border">$120.00</td>
                        <td class="p-2 border">$10.91</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="p-2 border">Taxable Rent</th>
                        <th class="p-2 border">GST Free Rent</th>
                        <th class="p-2 border">Misc Credit</th>
                        <th class="p-2 border">Others</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border">
                        <td class="p-2 border">$1000.00</td>
                        <td class="p-2 border">$4190.00</td>
                        <td class="p-2 border">$0.00</td>
                        <td class="p-2 border">$0.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3 block w-full bg-indigo-600 antialiased italic rounded-b-lg p-2"></div>
    </div>

@endsection

@push('js')
@endpush
