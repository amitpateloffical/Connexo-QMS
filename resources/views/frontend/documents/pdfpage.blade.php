<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DMS Document</title>

    <style>
        table {
            width: 100%;
        }

        td,
        th {
            text-align: center;
            
        }

        .w-5 {
            width: 5%;
        }

        .w-10 {
            width: 10%;
        }

        .w-15 {
            width: 15%;
        }

        .w-20 {
            width: 20%;
        }

        .w-25 {
            width: 25%;
        }

        .w-30 {
            width: 30%;
        }

        .w-33 {
            width: 33%;
        }

        .w-35 {
            width: 35%;
        }

        .w-40 {
            width: 40%;
        }

        .w-45 {
            width: 45%;
        }

        .w-50 {
            width: 50%;
        }

        .w-55 {
            width: 55%;
            
        }

        .w-60 {
            width: 60%;
        }

        .w-65 {
            width: 65%;
        }

        .w-70 {
            width: 70%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-75 {
            width: 75%;
        }

        .w-80 {
            width: 80%;
        }

        .w-85 {
            width: 85%;
        }

        .w-90 {
            width: 90%;
        }

        .w-95 {
            width: 95%;
        }

        .w-100 {
            width: 100%;
        }

        .border {
            border: 1px solid black;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .border-left {
            border-left: 1px solid black;
        }

        .border-right {
            border-right: 1px solid black;
        }

        .border-top-none {
            border-top: 0px solid black;
        }

        .border-bottom-none {
            border-bottom: 0px solid black;
        }

        .border-left-none {
            border-left: 0px solid black;
        }

        .border-right-none {
            border-right: 0px solid black;
        }

        .p-20 {
            padding: 20px;
        }

        .p-10 {
            padding: 10px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }

        .mb-40 {
            margin-bottom: 40px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .text-left {
            text-align: left;
            word-wrap: break-word;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
            
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .vertical-baseline {
            vertical-align: baseline;
        }

        table.table-bordered {
            border-collapse: collapse;
            border: 1px solid grey;

        }

        table.table-bordered td,
        table.table-bordered th {
            border: 1px solid grey;
            padding: 5px 10px;

        }

        table.small-content td,
        table.small-content th {
            font-size: 0.85rem;

        }

        td.title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        td.logo img {
            width: 100%;
            max-width: 100px;
            aspect-ratio: 1/0.35;

        }

        td.doc-num {
            font-size: 1rem;
            font-weight: bold;

        }

        .doc-control .head {
            max-width: 600px;
            margin: 0 auto 30px;

        }

        .doc-control .head div:nth-child(1) {
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 5px;

        }

        .doc-control .body .block-head {
            border-bottom: 2px solid black;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        @page {
            size: A4;
            margin-top: 220px;
            margin-bottom: 80px;

        }

        header {
            width: 100%;
            position: fixed;
            top: -200px;
            right: 0;
            left: 0;
            display: block;

        }

       
        .footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            width: 100%;
            display: block;
            border-top: 1px solid #ddd; /* Optional: Add a border at the top of the footer */
        }


        .other-container {
            margin: 40px 0;

        }

        .other-container>table {
            margin: 0px 0 0;

        }

        .scope-block,
        .procedure-block {
            margin: 10px 0 30px;
            word-wrap: break-word;
        }

        .annexure-block {
            margin: 40px 0 0;
        }

        .empty-page {
            page-break-after: always;
        }

        #pdf-page {
            /* page-break-inside: avoid; */
        }
        .page-break-before {
            page-break-before: always;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

    .MsoNormalTable, 
    table{
        margin: 0px !important;
        width : 100% !important;
    }


    </style>

</head>

<body>

    <header  style="margin-bottom: 100px;" class="">
        <table class="border" >
            <tbody>
                <tr>
                    <td class="logo w-20">
                        <img src="https://dms.mydemosoftware.com/user/images/logo.png" alt="..." style="margin-top: 0.5rem; margin-bottom: 1rem;"> 
                    </td>
                    <td class="title w-60" 
                    style="padding: 0px;  margin: 0px; border-left: 1px solid rgb(104, 104, 104); border-right: 1px solid rgb(104, 104, 104);">
                        <p 
                        style="margin-top: -0.1rem; border-bottom: 1px solid rgb(104, 104, 104);">Environmental Laboratory</p>
                        <br>
                        <p style="margin-top: -2rem; margin-bottom: 0px;">

                            {{ $data->document_name }}
                        </p>
                    </td>
                    <td class="logo w-20 h-20">
                        <img src="https://environmentallab.doculife.co.in/public/user/images/logo1.png" alt="..." style="max-height: 60px;">
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border border-top-none p-10">
            <tbody>
                <tr>
                    <td class="doc-num w-100"> 
                        @php
                        $temp = DB::table('document_types')
                            ->where('name', $data->document_type_name)
                            ->value('typecode');
                       @endphp
                        @if($data->revised === 'Yes') 
                               
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->revised_doc }}/R{{$data->major}}.{{$data->minor}}

                        @else
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                        /000{{ $data->id }}/R{{$data->major}}.{{$data->minor}}
                    @endif
                </tr>
            </tbody>
        </table>
    </header>
    <footer class="footer">
        <table class="border p-20">
            <tbody>
                <tr>
                    <td class="text-left w-36">
                                @php
                                $temp = DB::table('document_types')
                                    ->where('name', $data->document_type_name)
                                    ->value('typecode');
                                @endphp
                            @if($data->revised === 'Yes') 
                               
                            {{ Helpers::getDivisionName($data->division_id) }}
                            /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                            /000{{ $data->revised_doc }}/R{{$data->major}}.{{$data->minor}}

                            @else
                            {{ Helpers::getDivisionName($data->division_id) }}
                            /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                            /000{{ $data->id }}/R{{$data->major}}.{{$data->minor}}                           
                        @endif
                        
                    <td class="w-36">Printed On : {{ $time }}</td>
                    <td class="text-right w-20"></td>
                </tr>
            </tbody>
        </table>
    </footer>

    <section  class="main-section" id="pdf-page">
        <section style="page-break-after: never;">
            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">1.</th>
                            <th class="text-left">Purpose</th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:700px; ">
                                    {{ $data->document_content->purpose }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="other-container">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">2.</th>
                            <th class="text-left">Scope</th>
                        </tr>
                    </thead>
                </table>
                <div class="scope-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div class="text-justify" style="height:auto; overflow-x:hidden; width:700px; ">
                                    {{ $data->document_content->scope }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">3.</th>
                        <th class="w-95 text-left">
                            <div class="mb-10">Responsibility</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->responsibility))
                                            @foreach (unserialize($data->document_content->responsibility) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">3.<?php echo $i; ?></td>
                                                        <td class="w-95 text-left">

                                                            {{ $res }}

                                                        </td>
                                                        @php
                                                            $i = $i + 1;

                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">4.</th>
                        <th class="w-95 text-left">
                            <div class="mb-10">Abbreviation</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>

                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->abbreviation))
                                            @foreach (unserialize($data->document_content->abbreviation) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">4.<?php echo $i; ?></td>
                                                        <td class="w-95 text-justify">
                                                            {{ $res }}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">5.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10">Definitions</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="definition-block">
                                <table>
                                    <tbody>
                                        @php
                                            $definitions = unserialize($data->document_content->defination);
                                            $contentLength = 0;
                                            $maxContentLengthPerPage = 3000; 
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->defination))
                                            @foreach ($definitions as $index => $definition)
                                                {{--@if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">5.<?php echo $i; ?></td>
                                                        <td class="w-95 text-justify">
                                                            {{ $res }}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif --}}
                                                @if (!empty($definition))
                                                    @php
                                                        $contentLength += strlen($definition);
                                                    @endphp
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">{{ '5.' . ($index + 1) }}</td>
                                                        <td class="w-95 text-justify">{{ $definition }}</td>
                                                    </tr>
                                                    @if ($contentLength >= $maxContentLengthPerPage)
                                                        </tbody></table>
                                                        <div style="page-break-after: always;"></div> <!-- Force a page break -->
                                                        <table><tbody>
                                                        @php
                                                            $contentLength = 0; // Reset content length after a break
                                                        @endphp
                                                    @endif
                                                @endif

                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">6.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10">Materials & Equipments</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->materials_and_equipments))
                                            @foreach (unserialize($data->document_content->materials_and_equipments) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">6.<?php echo $i; ?></td>
                                                        <td class="w-95 text-left">
                                                            {{ $res }}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="other-container ">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">7.</th>
                            <th class="text-left">Procedure</th>
                        </tr>
                    </thead>
                </table>
                <div class="procedure-block">
                    <div class="w-100">
                        <div class="w-100" style="display:inline-block;">
                            <div class="w-100">
                                <div style="height:auto; overflow-x:hidden; width:650px; ">
                                    {{-- {!! $data->document_content->procedure !!} --}}

                                    {!! strip_tags($data->document_content->procedure, '<br><table><th><td><tbody><tr><p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="mb-20 ">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">8.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10">Reporting</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->reporting))
                                            @foreach (unserialize($data->document_content->reporting) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">8.<?php echo $i; ?></td>
                                                        <td class="w-95 text-left">
                                                            {!! strip_tags($res, '<br><table><th><td><tbody><tr><p>') !!}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">9.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10"> References</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->references))
                                            @foreach (unserialize($data->document_content->references) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">9.<?php echo $i; ?></td>
                                                        <td class="w-95 text-left">
                                                            {{ $res }}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="mb-20">
                <tbody>
                    <tr>
                        <th class="w-5 vertical-baseline">10.</th>
                        <th class="w-95 text-left">
                            <div class="bold mb-10">Annexure</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div>
                                <table>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (!empty($data->document_content->ann))
                                            @foreach (unserialize($data->document_content->ann) as $res)
                                                @if (!empty($res))
                                                    <tr>
                                                        <td class="w-5 vertical-baseline">10.<?php echo $i; ?></td>
                                                        <td class="w-95 text-left">
                                                            {!! strip_tags($res, '<br><table><th><td><tbody><tr><p>') !!}
                                                        </td>
                                                        @php
                                                            $i = $i + 1;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            @php
                $i = 1;
            @endphp
            @if (!empty($data->document_content->annexuredata))
                @foreach (unserialize($data->document_content->annexuredata) as $res)
                    @if (!empty($res))
                        <div class="annexure-block">
                            <div class="w-100">
                                <div class="w-100" style="display:inline-block;">
                                    <div class="w-100">
                                        <div style="height:auto; overflow-x:hidden; width:650px; ">
                                            {!! strip_tags($res, '<br><table><th><td><tbody><tr><p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </section>

        <section class="doc-control" style="page-break-after: never;">
            <div class="head">
                <div>
                    Document Control Information
                </div>
            </div>
            <div class="body">
                <div class="block mb-40">
                    <div class="block-head">
                        General Information
                    </div>
                    <div class="block-content">
                        <table>
                            <tbody>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Document Number</th>
                                    <td class="w-70 text-left">
                                        @php
                                        $temp = DB::table('document_types')
                                            ->where('name', $data->document_type_name)
                                            ->value('typecode');
                                       @endphp
                                        @if($data->revised === 'Yes') 
                                           
                                        {{ Helpers::getDivisionName($data->division_id) }}
                                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                                        /000{{ $data->revised_doc }}/R{{$data->major}}.{{$data->minor}}

                                        @else
                                        {{ Helpers::getDivisionName($data->division_id) }}
                                        /@if($data->document_type_name){{  $temp }} /@endif{{ $data->year }}
                                        /000{{ $data->id }}/R{{$data->major}}.{{$data->minor}}
                                        
                                    @endif
                                </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Title</th>
                                    <td class="w-70 text-left">{{ $data->document_name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">
                                        Short Description
                                    </th>
                                    <td class="w-70 text-left">
                                        {{ $data->short_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Description</th>
                                    <td class="w-70 text-left">
                                        {{ $data->description }}
                                    </td>
                                </tr>
                                @php
                                    $last = DB::table('document_histories')
                                        ->where('document_id', $data->id)
                                        ->latest()
                                        ->first();
                                @endphp

                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Last Changed</th>
                                    <td class="w-70 text-left">
                                        @if ($last)
                                            {{ $last->created_at }}
                                        @else
                                            {{ $data->created_at }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w-30 text-left vertical-baseline">Changed By</th>
                                    <td class="w-70 text-left">
                                        @if ($last)
                                            {{ $last->user_name }}
                                        @else
                                            {{ $data->originator }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @php
                $signatureOriginatorData = DB::table('stage_manages')
                                                    ->where('document_id', $data->id)
                                                    ->where(function ($query) {
                                                        $query->where('stage', 'In-Review')
                                                            ->orWhere('stage', 'For-Approval');
                                                    })
                                                    ->latest()
                                                    ->first();

                                                    $signatureReviewerData = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('stage', 'Reviewed')
                                                ->latest()
                                                ->first();

                                                    $signatureApprovalData = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('stage', 'Approved')
                                                ->latest()
                                                ->first();
                @endphp
                <div class="block mb-40">
                    <div class="block-head">
                        Originator
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Originator</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                dd($data);
                                @endphp --}}
                                <tr>
                                    <td class="text-left w-25">{{ $data->originator }}</td>
                                    <td class="text-left w-25">{{ $document->originator && $document->originator->department ? $document->originator->department->name : '' }}</td>
                                    <td class="text-left w-25">Initiation Completed</td>
                                    <td class="text-left w-25">{{ $data->originator_email }}</td>
                                    <td class="text-left w-25">{{ !$signatureOriginatorData || $signatureOriginatorData->comment == null ? " " : $signatureOriginatorData->comment }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block mb-40">
                    <div class="block-head">
                        Reviews
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Reviewer</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->reviewers)
                                    @php
                                        $reviewer = explode(',', $data->reviewers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($reviewer); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $reviewer[$i])
                                                ->first();
                                            $dept = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                            $date = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Reviewed')
                                                ->latest()
                                                ->first();
                                            $reject = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Cancel-by-Reviewer')
                                                ->latest()
                                                ->first();

                                        @endphp
                                        <tr>
                                            <td class="text-left w-25">{{ $user->name }}</td>
                                            <td class="text-left w-25">{{ $dept }}</td>
                                            @if ($date)
                                                <td class="text-left w-25">Review Completed</td>
                                            @elseif(!empty($reject))
                                                <td class="text-left w-25">Review Rejected </td>
                                            @else
                                                <td class="text-left w-25">Review Pending</td>
                                            @endif                                                

                                            <td class="text-left w-25">{{ $user->email }}</td>
                                            <td class="text-left w-25">{{ !$signatureReviewerData || $signatureReviewerData->comment == null ? " " : $signatureReviewerData->comment }}</td>

                                        </tr>
                                    @endfor
                                @endif
                                @if ($data->reviewers_group)
                                    @php
                                        $group = explode(',', $data->reviewers_group);
                                        $i = 0;

                                    @endphp
                                    @for ($i = 0; $i < count($group); $i++)
                                        @php

                                            $users_id = DB::table('group_permissions')
                                                ->where('id', $group[$i])
                                                ->value('user_ids');
                                            $reviewer = explode(',', $users_id);
                                            $i = 0;
                                        @endphp
                                        @if ($users_id)
                                            @for ($i = 0; $i < count($reviewer); $i++)
                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $reviewer[$i])
                                                        ->first();
                                                    $dept = DB::table('departments')
                                                        ->where('id', $user->departmentid)
                                                        ->value('name');
                                                    $date = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Review-Submit')
                                                        ->latest()
                                                        ->first();
                                                    $reject = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Cancel-by-Reviewer')
                                                        ->latest()
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td class="text-left w-25">{{ $user->name }}</td>
                                                    <td class="text-left w-25">{{ $dept }}</td>
                                                    @if ($date)
                                                        <td class="text-left w-25">Review Completed</td>
                                                    @elseif(!empty($reject))
                                                        <td class="text-left w-25">Review Rejected </td>
                                                    @else
                                                        <td class="text-left w-25">Review Pending</td>
                                                    @endif

                                                    <td class="text-left w-25">{{ $user->email }}</td>
                                                </tr>
                                            @endfor
                                        @endif
                                    @endfor


                                @endif

                            </tbody>
                            {{-- <tbody>
                                    <tr>
                                        <td class="text-left w-25">Vivek</td>
                                        <td class="text-left w-25">Quality Control</td>
                                        <td class="text-left w-25">12-12-2023 11:12PM</td>
                                        <td class="text-left w-25">vivek@gmail.com</td>
                                    </tr>
                                </tbody> --}}
                        </table>
                    </div>
                </div>
                <div class="block mb-40">
                    <div class="block-head">
                        Approvals
                    </div>
                    <div class="block-content">
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left w-25">Approver</th>
                                    <th class="text-left w-25">Department</th>
                                    <th class="text-left w-25">Status</th>
                                    <th class="text-left w-25">E-Signature</th>
                                    <th class="text-left w-25">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->approvers)
                                    @php
                                        $reviewer = explode(',', $data->approvers);
                                        $i = 0;
                                    @endphp
                                    @for ($i = 0; $i < count($reviewer); $i++)
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $reviewer[$i])
                                                ->first();
                                            $dept = DB::table('departments')
                                                ->where('id', $user->departmentid)
                                                ->value('name');
                                            $date = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Approved')
                                                ->latest()
                                                ->first();
                                            $reject = DB::table('stage_manages')
                                                ->where('document_id', $data->id)
                                                ->where('user_id', $reviewer[$i])
                                                ->where('stage', 'Cancel-by-Approver')
                                                ->latest()
                                                ->first();
                                                
                                        @endphp
                                        <tr>
                                            <td class="text-left w-25">{{ $user->name }}</td>
                                            <td class="text-left w-25">{{ $dept }}</td>
                                            @if ($date)
                                                <td class="text-left w-25">Approval Completed</td>
                                            @elseif(!empty($reject))
                                                <td>Approval Rejected</td>
                                            @else
                                                <td class="text-left w-25">Approval Pending</td>
                                            @endif

                                            <td class="text-left w-25">{{ $user->email }}</td>
                                            <td class="text-left w-25">{{ !$signatureApprovalData || $signatureApprovalData->comment == null ? " " : $signatureApprovalData->comment }}</td>
                                        </tr>
                                    @endfor
                                @endif
                                @if ($data->approver_group)
                                    @php
                                        $group = explode(',', $data->approver_group);
                                        $i = 0;

                                    @endphp
                                    @for ($i = 0; $i < count($group); $i++)
                                        @php

                                            $users_id = DB::table('group_permissions')
                                                ->where('id', $group[$i])
                                                ->value('user_ids');
                                            $reviewer = explode(',', $users_id);
                                            $i = 0;
                                        @endphp
                                        @if ($users_id)
                                            @for ($i = 0; $i < count($reviewer); $i++)
                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $reviewer[$i])
                                                        ->first();
                                                    $dept = DB::table('departments')
                                                        ->where('id', $user->departmentid)
                                                        ->value('name');
                                                    $date = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Approval-Submit')
                                                        ->latest()
                                                        ->first();
                                                    $reject = DB::table('stage_manages')
                                                        ->where('document_id', $data->id)
                                                        ->where('user_id', $reviewer[$i])
                                                        ->where('stage', 'Cancel-by-Approver')
                                                        ->latest()
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td class="text-left w-25">{{ $user->name }}</td>
                                                    <td class="text-left w-25">{{ $dept }}</td>
                                                    @if ($date)
                                                        <td class="text-left w-25">Approval Completed</td>
                                                    @elseif(!empty($reject))
                                                        <td class="text-left w-25">Approval Rejected </td>
                                                    @else
                                                        <td class="text-left w-25">Approval Pending</td>
                                                    @endif

                                                    <td class="text-left w-25">{{ $user->email }}</td>                                  
                                                </tr>
                                            @endfor
                                        @endif
                                    @endfor


                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </section>

  

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 788;
                    $x = 490;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
        </script>
</body>

</html>
