@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }
        .sop-type-header {
            display: grid;
            grid-template-columns: 135px 1fr;
            border: 2px solid #000000;
            margin-bottom: 20px;
                }
                .main-head {
            display: grid;
            place-items: center;
            align-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            border-left: 2px solid #000000;
        }
        .sub-head-2 {
            text-align: center;
            background: #4274da;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 1.5rem;
            color: #fff;
            border: 2px solid #000000;
            border-radius: 40px;
        }
    </style>

    <div id="data-fields">
        <div class="container-fluid">
            <div class="tab">
            <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document information</button>
                {{-- <button class="tablinks" onclick="openData(event, 'doc-chem')">Chemistry SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-instru')">Instrument SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-instrumental')">Instrumental Chemistry SOP</button>
                <button class="tablinks" onclick="openData(event, 'doc-micro')">Microbiology SOP</button> 
                <button class="tablinks" onclick="openData(event, 'doc-lab')">Good Laboratory Practices</button>
                <button class="tablinks" onclick="openData(event, 'doc-wet')">Wet Chemistry</button>
                <button class="tablinks" onclick="openData(event, 'doc-others')">Others</button> --}}
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks" onclick="openData(event, 'doc-content')">Document Content</button>
                <button class="tablinks" onclick="openData(event, 'annexures')">Annexures</button>
                <button class="tablinks" onclick="openData(event, 'distribution-retrieval')">Distribution & Retrieval</button>
                {{-- <button class="tablinks" onclick="openData(event, 'print-download')">Print and Download Control </button> --}}
                <button class="tablinks" onclick="openData(event, 'sign')">Signature</button>

            </div>
            <form method="POST" action="{{ route('documents.update', $document->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tab content -->
                {{-- @foreach ($history as $tempHistory) --}}
                <div id="doc-info" class="tabcontent">
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="originator">Originator</label>
                                    <div class="default-name">{{ $document->originator_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="open-date">Date Opened</label>
                                    <div class="default-name"> {{ $document->date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Division Code"><b>Site/Location Code</b></label>
                                    <input disabled type="text" name="division_code"
                                        value="{{ Helpers::getDivisionName($document->division_id) }}">
                                    {{-- <div class="static">QMS-North America</div> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="document_name-desc">Document Name*</label>
                                    <input type="text" name="document_name" id="docname"
                                    {{Helpers::isRevised($document->stage)}}   value="{{ $document->document_name }}" required>


                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Document Name' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach



                                </div>
                                <p id="docnameError" style="color:red">**Document Name is required</p>

                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>
                                        <input class="input-field" type="text" name="document_name_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>

                            @endif
                           
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="short-desc">Short Description*</label>
                                    <input type="text" name="short_desc" id="short_desc"
                                     {{Helpers::isRevised($document->stage)}} 
                                        value="{{ $document->short_description }}">
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Short Description' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="short_descError" style="color:red">**Short description is required</p>

                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="short_desc_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>

                            @endif

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="sop_type">SOP Type</label>
                                    <select name="sop_type" {{Helpers::isRevised($document->stage)}} >
                                        <option  value="0">-- Select --</option>
                                        <option @if ($document->sop_type =='Chemistry SOP') selected @endif
                                            value="Chemistry SOP">Chemistry SOP</option>
                                            <option @if ($document->sop_type =='Instrument SOP') selected @endif
                                                value="Instrument SOP">Instrument SOP</option>
                                                <option @if ($document->sop_type =='Analytical SOP') selected @endif
                                                    value="Analytical SOP">Analytical SOP</option>
                                                    <option @if ($document->sop_type =='Microbiology SOP') selected @endif
                                                        value="Microbiology SOP">Microbiology SOP</option>
                                                        <option @if ($document->sop_type =='Quality Policies') selected @endif
                                                            value="Quality Policies">Quality Policies</option>
                                                            <option @if ($document->sop_type =='Others') selected @endif
                                                                value="Others">Others</option>
                                    </select>
                                    @foreach ($history as $tempHistory)
                                    @if (
                                        $tempHistory->activity_type == 'SOP Type' &&
                                            !empty($tempHistory->comment) &&
                                            $tempHistory->user_id == Auth::user()->id)
                                        @php
                                            $users_name = DB::table('users')
                                                ->where('id', $tempHistory->user_id)
                                                ->value('name');
                                        @endphp
                                        <p style="color: blue">Modify by {{ $users_name }} at
                                            {{ $tempHistory->created_at }}
                                        </p>
                                        <input class="input-field"
                                            style="background: #ffff0061;
                                        color: black;"
                                            type="text" value="{{ $tempHistory->comment }}" disabled>
                                    @endif
                                    @endforeach
                                </div>
                                @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                            at {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="sop_type_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif   
                            </div>
                            <div class="col-md-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date</label>
                                    <div><small class="text-primary" >Kindly Fill Target Date of Completion</small>
                                    </div>
                                    <div class="calenderauditee">                                     
                                        <input type="text"  id="due_dateDoc" value="{{ $document->due_dateDoc }}" {{Helpers::isRevised($document->stage)}}   readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_dateDoc" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'due_dateDoc')"/>
                                    </div>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Due Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="due_dateDocError" style="color:red">**Due Date is required</p>

                                @if (Auth::user()->role != 3)

                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                                {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="due_date_comment">
                                        </div>

                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-8">
                                <div class="group-input">
                                    <label for="notify_to">Notify To</label>
                                    <select multiple name="notify_to[]" placeholder="Select Persons" data-search="false"
                                        data-silent-initial-value-set="true" id="notify_to" {{Helpers::isRevised($document->stage)}} >
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                ({{ $data->role }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Notify To' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)

                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="notify_to_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="description">Description</label>
                                    <textarea name="description" {{Helpers::isRevised($document->stage)}} >{{ $document->description }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Description' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="description_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="orig-head">
                        Document Information
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-num">Document Number</label>
                                    <div class="default-name">
                                        @if($document->revised === 'Yes') 
                                           
                                        {{ Helpers::getDivisionName($document->division_id) }}
                                        /@if($document->document_type_name){{ $document->document_type_name }} /@endif{{ $year }}
                                        /000{{ $document->revised_doc }}/R{{$document->major}}.{{$document->minor}}

                                        @else
                                        {{ Helpers::getDivisionName($document->division_id) }}
                                        /@if($document->document_type_name){{ $document->document_type_name }} /@endif{{ $year }}
                                        /000{{ $document->id }}/R{{$document->major}}.{{$document->minor}}
                                        
                                    @endif
                                    </div>
                                        
                                        {{-- {{ $document->division_name }} --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="link-doc">Reference Record</label>
                                    <select multiple name="reference_record[]" placeholder="Select Reference Records"
                                        data-search="false" data-silent-initial-value-set="true" id="reference_record" {{Helpers::isRevised($document->stage)}} >
                                        @if (!empty($document_data))
                                            @foreach ($document_data as $temp)
                                            
                                                <option value="{{ $temp->id }}">
                                                    {{ $temp->division }}/{{ $temp->typecode }}/{{ $temp->year }}/SOP-000{{ $temp->id }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Reference Record' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)

                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="reference_record_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="depart-name">Department Name</label>
                                    <select name="department_id" id="depart-name" {{Helpers::isRevised($document->stage)}} >
                                        <option value="">Enter your Selection</option>
                                            <option value="CQA"
                                                @if ($document->department_id == 'CQA') selected @endif>Corporate
                                                Quality Assurance</option>
                                            <option value="QAB"
                                                @if ($document->department_id == 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC"
                                                @if ($document->department_id == 'CQC') selected @endif>Central
                                                Quality Control</option>
                                            <option value="MANU"
                                                @if ($document->department_id == 'MANU') selected @endif>Manufacturing
                                            </option>
                                            <option value="PSG"
                                                @if ($document->department_id == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS"
                                                @if ($document->department_id == 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG"
                                                @if ($document->department_id == 'ITG') selected @endif>Information
                                                Technology Group</option>
                                            <option value="MM"
                                                @if ($document->department_id == 'MM') selected @endif>Molecular
                                                Medicine</option>
                                            <option value="CL"
                                                @if ($document->department_id == 'CL') selected @endif>Central
                                                Laboratory</option>
                                            <option value="TT"
                                                @if ($document->department_id == 'TT') selected @endif>Tech
                                                Team</option>
                                            <option value="QA"
                                                @if ($document->department_id == 'QA') selected @endif>Quality
                                                Assurance</option>
                                            <option value="QM"
                                                @if ($document->department_id == 'QM') selected @endif>Quality
                                                Management</option>
                                            <option value="IA"
                                                @if ($document->department_id == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC"
                                                @if ($document->department_id == 'ACC') selected @endif>Accounting
                                            </option>
                                            <option value="LOG"
                                                @if ($document->department_id == 'LOG') selected @endif>Logistics
                                            </option>
                                            <option value="SM"
                                                @if ($document->department_id == 'SM') selected @endif>Senior
                                                Management</option>
                                            <option value="BA"
                                                @if ($document->department_id == 'BA') selected @endif>Business
                                                Administration</option>
                                            <option value="BA"
                                                @if ($document->department_id == 'others') selected @endif>Others
                                                </option>
                                        @foreach ($departments as $department)
                                            <option data-id="{{ $department->dc }}" value="{{ $department->id }}"
                                                {{ $department->id == $document->department_id ? 'selected' : '' }}>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Department' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="depart-nameError" style="color:red">**Department Name is required</p>


                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="department_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="depart-code">Department Code</label>
                                    <div class="default-name"> <span id="department-code">
                                            @if (!empty($departments))
                                                @foreach ($departments as $department)
                                                    {{ $document->department_id == $department->id ? $department->dc : '' }}
                                                @endforeach
                                            @else
                                                Not Selected
                                            @endif

                                        </span></div>
                                </div>
                            </div> --}}

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="major">Major<span class="text-danger">*</span>
                                        <span  class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#document-management-system-modal"
                                        style="font-size: 0.8rem; font-weight: 400;">
                                        (Launch Instruction) </span>
                                    </label>
                                    <input type="number" name="major" id="major" min="0"  value="{{ $document->major }}" required {{Helpers::isRevised($document->stage)}} >
                                    
                                    @foreach ($history as $tempHistory)
                                    @if (
                                        $tempHistory->activity_type == 'Major' &&
                                            !empty($tempHistory->comment) &&
                                            $tempHistory->user_id == Auth::user()->id)
                                        @php
                                            $users_name = DB::table('users')
                                                ->where('id', $tempHistory->user_id)
                                                ->value('name');
                                        @endphp
                                        <p style="color: blue">Modify by {{ $users_name }} at
                                            {{ $tempHistory->created_at }}
                                        </p>
                                        <input class="input-field"
                                            style="background: #ffff0061;
                                color: black;"
                                            type="text" value="{{ $tempHistory->comment }}" disabled>
                                    @endif
                                @endforeach
                                </div> 
                                @if (Auth::user()->role != 3)
                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                            at {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="major_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif 
                            </div>
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="minor">Minor<span class="text-danger">*</span> 
                                        <span  class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#document-management-system-modal-minor"
                                        style="font-size: 0.8rem; font-weight: 400;">
                                        (Launch Instruction)
                                        </span>
                                    </label>
                                    <input type="number" name="minor" id="minor" min="0" max="9"  value="{{ $document->minor }}" required {{Helpers::isRevised($document->stage)}} >
                                    {{-- <select  name="minor">
                                        <option  value="00">-- Select --</option>
                                        <option @if ($document->minor =='0') selected @endif
                                            value="0">0</option>
                                        <option @if ($document->minor =='1') selected @endif
                                            value="1">1</option>
                                            <option @if ($document->minor =='2') selected @endif
                                                value="2">2</option>
                                            <option @if ($document->minor =='3') selected @endif
                                                value="3">3</option>
                                            <option @if ($document->minor =='4') selected @endif
                                                value="4">4</option>
                                                <option @if ($document->minor =='5') selected @endif
                                                    value="5">5</option>
                                                    <option @if ($document->minor =='6') selected @endif
                                                        value="6">6</option>
                                                        <option @if ($document->minor =='7') selected @endif
                                                            value="7">7</option>
                                                            <option @if ($document->minor =='8') selected @endif
                                                                value="8">8</option>
                                                                <option @if ($document->minor =='9') selected @endif
                                                                    value="9">9</option>
                                    </select> --}}
                                    @foreach ($history as $tempHistory)
                                    @if (
                                        $tempHistory->activity_type == 'Minor' &&
                                            !empty($tempHistory->comment) &&
                                            $tempHistory->user_id == Auth::user()->id)
                                        @php
                                            $users_name = DB::table('users')
                                                ->where('id', $tempHistory->user_id)
                                                ->value('name');
                                        @endphp
                                        <p style="color: blue">Modify by {{ $users_name }} at
                                            {{ $tempHistory->created_at }}
                                        </p>
                                        <input class="input-field"
                                            style="background: #ffff0061;
                                color: black;"
                                            type="text" value="{{ $tempHistory->comment }}" disabled>
                                    @endif
                                @endforeach
                                </div>
                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="minor_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-type">Document Type</label>
                                    <select name="document_type_id" id="doc-type" {{Helpers::isRevised($document->stage)}} >
                                        <option value="">Enter your Selection</option>
                                        @foreach ($documentTypes as $type)
                                            <option data-id="{{ $type->typecode }}" value="{{ $type->id }}"
                                                {{ $type->id == $document->document_type_id ? 'selected' : '' }}>
                                                {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="document_type_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-code">Document Type Code</label>
                                    <div class="default-name"> <span id="document_type_code">
                                            @if (!empty($documentTypes))
                                                @foreach ($documentTypes as $type)
                                                    {{ $document->document_type_id == $type->id ? $type->typecode : '' }}
                                                @endforeach
                                            @else
                                                Not Selected
                                            @endif

                                        </span> </div>

                                </div>
                            </div>
                            <p id="doc-typeError" style="color:red">**Document Type is required</p>

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-type">Document Sub Type</label>
                                    <select name="document_subtype_id" id="doc-subtype">
                                        <option value="">Enter your Selection</option>
                                        @foreach ($documentsubTypes as $type)
                                            <option data-id="{{ $type->code }}" value="{{ $type->id }}"
                                                {{ $type->id == $document->document_subtype_id ? 'selected' : '' }}>
                                                {{ $type->docSubtype }}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Document Sub Type' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>



                                @if (Auth::user()->role != 3)
                                 Add Comment  
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="document_type_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-code">Document Type Code</label>
                                    <div class="default-name"> <span id="document_type_code">
                                            @if (!empty($documentTypes))
                                                @foreach ($documentTypes as $type)
                                                    {{ $document->document_type_id == $type->id ? $type->typecode : '' }}
                                                @endforeach
                                            @else
                                                Not Selected
                                            @endif

                                        </span> </div>
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-lang">Document Language</label>
                                    <select name="document_language_id" id="doc-lang" {{Helpers::isRevised($document->stage)}} >
                                        <option value="">Enter your Selection</option>
                                        @foreach ($documentLanguages as $lan)
                                            <option data-id="{{ $lan->lcode }}" value="{{ $lan->id }}"
                                                {{ $lan->id == $document->document_language_id ? 'selected' : '' }}>
                                                {{ $lan->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Document Language' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="document_language_id_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-lang">Document Language Code</label>
                                    <div class="default-name"><span id="document_language">
                                            @if (!empty($documentLanguages))
                                                @foreach ($documentLanguages as $lan)
                                                    {{ $document->document_language_id == $lan->id ? $lan->lcode : '' }}
                                                @endforeach
                                            @else
                                                Not Selected
                                            @endif

                                        </span></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="keyword">Keywords</label>
                                    <div class="add-keyword">
                                        <input type="text" id="sourceField" class="mb-0" {{Helpers::isRevised($document->stage)}} >
                                        <button id="addButton" type="button">ADD</button>
                                    </div>
                                    <select name="keywords[]" class="targetField" multiple id="keywords">
                                        @if (!empty($keywords))
                                            @foreach ($keywords as $lan)
                                                <option value="{{ $lan->id }}"
                                                    @if ($document->keywords) @php
                                               $data = explode(",",$document->keywords);
                                                $count = count($data);
                                                $i=0;
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                @if ($data[$i] == $lan->keyword)
                                                 selected @endif
                                                    @endfor
                                            @endif
                                            >
                                            {{ $lan->keyword }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Keywords' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="effective-date">Effective Date</label>
                                    <div class="calenderauditee">                                     
                                        <input type="text"  id="effective_date" value="{{ $document->effective_date }}" readonly placeholder="DD-MMM-YYYY" {{Helpers::isRevised($document->stage)}}  />
                                        <input type="date" name="effective_date" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'effective_date')"/>
                                    </div>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Effective Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>

                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="effective_date_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                              <div class="col-md-4">
                                <div class="group-input">
                                    <label for="review-period">Review Period</label>
                                    <input type="number" name="review_period" id="review_period" {{Helpers::isRevised($document->stage)}}  value="{{ $document->review_period }}">
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Review Period' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="review_period_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-4 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="review-date">Next Review Date</label>
                                    <!-- <input type="date" name="next_review_date" id="next_review_date"
                                        value="{{ $document->next_review_date }}"> -->

                                        <div class="calenderauditee">                                     
                                        <input type="text"  id="next_review_date" value="{{ $document->next_review_date }}" {{Helpers::isRevised($document->stage)}}  readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="next_review_date" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'next_review_date')"/>
                                        </div>

                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Next-Review Date' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="next_review_date_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>



                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="draft-doc">Attach Draft document</label>
                                    <input type="file" name="attach_draft_doocument" {{Helpers::isRevised($document->stage)}} 
                                        value="{{ $document->attach_draft_doocument }}">
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Draft Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="attach_draft_doocument_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="effective-doc">Attach Effective document</label>
                                    <input type="file" name="attach_effective_docuement" {{Helpers::isRevised($document->stage)}} 
                                        value="{{ $document->attach_effective_docuement }}">
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Effective Document' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                        color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text"
                                                name="attach_effective_docuement_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="orig-head">
                        Other Information
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="reviewers">Reviewers</label>
                                    <select id="choices-multiple-remove-button" class="choices-multiple-reviewer" {{Helpers::isRevised($document->stage)}} 
                                        name="reviewers[]" placeholder="Select Reviewers" multiple>
                                        @if (!empty($reviewer))
                                            @foreach ($reviewer as $lan)
                                                <option value="{{ $lan->id }}"
                                                    @if ($document->reviewers) @php
                                                   $data = explode(",",$document->reviewers);
                                                    $count = count($data);
                                                    $i=0;
                                                @endphp
                                                @for ($i = 0; $i < $count; $i++)
                                                    @if ($data[$i] == $lan->id)
                                                     selected @endif
                                                    @endfor
                                            @endif>
                                            {{ $lan->name }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Reviewers' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="reviewerError" style="color:red">**Reviewers are required</p>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="reviewers_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="approvers">Approvers</label>
                                    <select id="choices-multiple-remove-button" class="choices-multiple-approver" {{Helpers::isRevised($document->stage)}} 
                                        name="approvers[]" placeholder="Select Approvers" multiple>
                                        @if (!empty($approvers))
                                            @foreach ($approvers as $lan)
                                                <option value="{{ $lan->id }}"
                                                    @if ($document->approvers) @php
                                                   $data = explode(",",$document->approvers);
                                                    $count = count($data);
                                                    $i=0;
                                                @endphp
                                                @for ($i = 0; $i < $count; $i++)
                                                    @if ($data[$i] == $lan->id)
                                                     selected @endif
                                                    @endfor
                                            @endif>
                                            {{ $lan->name }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Approvers' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                                <p id="approverError" style="color:red">**Approvers are required</p>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="approvers_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="reviewers-group">Reviewers Group</label>
                                    <select id="choices-multiple-remove-button" name="reviewers_group[]" {{Helpers::isRevised($document->stage)}} 
                                        placeholder="Select Reviewers" multiple>
                                        @if (!empty($reviewergroup))
                                            @foreach ($reviewergroup as $lan)
                                                <option value="{{ $lan->id }}"
                                                    @if ($document->reviewers_group) @php
                                                   $data = explode(",",$document->reviewers_group);
                                                    $count = count($data);
                                                    $i=0;
                                                @endphp
                                                @for ($i = 0; $i < $count; $i++)
                                                    @if ($data[$i] == $lan->id)
                                                     selected @endif
                                                    @endfor
                                            @endif>
                                            {{ $lan->name }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Reviewers Group' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="reviewers_group_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="approvers-group">Approvers Group</label>
                                    <select id="choices-multiple-remove-button" name="approver_group[]" {{Helpers::isRevised($document->stage)}} 
                                        placeholder="Select Approvers" multiple>
                                        @if (!empty($approversgroup))
                                            @foreach ($approversgroup as $lan)
                                                <option value="{{ $lan->id }}"
                                                    @if ($document->approver_group) @php
                                                   $data = explode(",",$document->approver_group);
                                                    $count = count($data);
                                                    $i=0;
                                                @endphp
                                                @for ($i = 0; $i < $count; $i++)
                                                    @if ($data[$i] == $lan->id)
                                                     selected @endif
                                                    @endfor
                                            @endif>
                                            {{ $lan->name }}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if (
                                            $tempHistory->activity_type == 'Approvers Group' &&
                                                !empty($tempHistory->comment) &&
                                                $tempHistory->user_id == Auth::user()->id)
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>


                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="approver_group_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="revision-type">Revision Type</label>
                                    <select  name="revision_type" {{Helpers::isRevised($document->stage)}} >
                                        <option  value="0">-- Select --</option>
                                        <option @if ($document->revision_type =='minor') selected @endif
                                            value="minor">Minor</option>
                                            <option @if ($document->revision_type =='major') selected @endif
                                                value="major">Major</option>
                                        <option @if ($document->revision_type =='NA') selected @endif
                                            value="NA">NA</option>
                                    </select>
                                    @foreach ($history as $tempHistory)
                                    @if ($tempHistory->activity_type == 'Revision Type' && !empty($tempHistory->comment))
                                        @php
                                            $users_name = DB::table('users')
                                                ->where('id', $tempHistory->user_id)
                                                ->value('name');
                                        @endphp
                                        <p style="color: blue">Modify by {{ $users_name }} at
                                            {{ $tempHistory->created_at }}
                                        </p>
                                        <input class="input-field"
                                            style="background: #ffff0061;
                                color: black;"
                                            type="text" value="{{ $tempHistory->comment }}" disabled>
                                    @endif
                                @endforeach
                                </div>
                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="revision_type_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="summary">Revision Summary</label>

                                    <textarea name="revision_summary" {{Helpers::isRevised($document->stage)}} >{{ $document->revision_summary }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Revision Summary' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>

                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }}
                                                at {{ date('d-M-Y h:i:s') }}</p>

                                            <input class="input-field" type="text" name="revision_summary_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="nextButton" id="DocnextButton">Next</button>
                    </div>
                </div>
<!-- ------------------------------------------------------------------------------------------------------------- -->

 <!-- ------------------------------------------------------------------------------------------------------------- -->
                <div id="add-doc" class="tabcontent">
                    <div class="orig-head">
                        Training Information
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="train-require">Training Required?</label>
                                    <select name="training_required" {{Helpers::isRevised($document->stage)}}  required>
                                        <option value="">Enter your Selection</option>
                                        @if ($document->training_required == 'yes')
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                        @else
                                            <option value="no" selected>No</option>
                                            <option value="yes">Yes</option>
                                            
                                        @endif

                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Training Required' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="link-doc">Trainer</label>
                                    <select name="trainer" {{Helpers::isRevised($document->stage)}} >
                                        <option value="" selected>Enter your Selection</option>
                                        @foreach ($trainer as $temp)
                                            <option value="{{ $temp->id }}"
                                                @if (!empty($trainingDoc)) @if ($trainingDoc->trainer == $temp->id) selected @endif
                                                @endif>{{ $temp->name }}</option>
                                        @endforeach
                                    </select>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Trainer' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="launch-cbt">Launch CBT</label>
                                    <select name="cbt">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="training-type">Type</label>
                                    <select name="training-type">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="test">
                                        Test(0)<button type="button" name="test"
                                            onclick="addTrainRow('test')">+</button>
                                    </label>
                                    <table class="table-bordered table" id="test">
                                        <thead>
                                            <tr>
                                                <th class="row-num">Row No.</th>
                                                <th class="question">Question</th>
                                                <th class="answer">Answer</th>
                                                <th class="result">Result</th>
                                                <th class="comment">Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="test">
                                        Survey(0)<button type="button" name="reporting1"
                                            onclick="addTrainRow('survey')">+</button>
                                    </label>
                                    <table class="table-bordered table" id="survey">
                                        <thead>
                                            <tr>
                                                <th class="row-num">Row No.</th>
                                                <th class="question">Subject</th>
                                                <th class="answer">Topic</th>
                                                <th class="result">Rating</th>
                                                <th class="comment">Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" {{Helpers::isRevised($document->stage)}} ></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                <div id="doc-content" class="tabcontent">
                    <div class="orig-head">
                        Standard Operating Procedure
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="purpose">Purpose</label>
                                    <input type="text" name="purpose" {{Helpers::isRevised($document->stage)}} 
                                        value="{{ $document->document_content->purpose }}">
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Purpose' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="purpose_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="scope">Scope</label>

                                    <textarea name="scope" {{Helpers::isRevised($document->stage)}} >{{ $document->document_content->scope }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Scope' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="scope_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="responsibility" id="responsibility">
                                        Responsibility<button type="button" id="responsibilitybtnadd"
                                            name="button" {{Helpers::isRevised($document->stage)}} >+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->responsibility))
                                        @foreach (unserialize($document->document_content->responsibility) as $data)
                                            <input type="text" name="responsibility[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}} >
                                        @endforeach
                                    @else
                                        <input type="text" name="responsibility[]" class="myclassname" >
                                    @endif

                                    <div id="responsibilitydiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Responsibility' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)
                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="responsibility_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="abbreviation" id="abbreviation">
                                        Abbreviation<button type="button" id="abbreviationbtnadd"
                                            name="button" {{Helpers::isRevised($document->stage)}} >+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->abbreviation))
                                        @foreach (unserialize($document->document_content->abbreviation) as $data)
                                            <input type="text" name="abbreviation[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}} >
                                        @endforeach
                                    @endif

                                    <div id="abbreviationdiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Abbreviation' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="abbreviation_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="abbreviation" id="definition">
                                        Definition<button type="button" id="Definitionbtnadd" name="button" {{Helpers::isRevised($document->stage)}} >+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->defination))
                                        @foreach (unserialize($document->document_content->defination) as $data)
                                            <input type="text" name="defination[]" class="myclassname" {{Helpers::isRevised($document->stage)}} 
                                                value="{{ $data }}">
                                        @endforeach
                                    @endif

                                    <div id="definitiondiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Definiton' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="defination_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="reporting" id="newreport">
                                        Materials and Equipments<button type="button" id="materialsbtadd"
                                            name="button" {{Helpers::isRevised($document->stage)}} >+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->materials_and_equipments))
                                        @foreach (unserialize($document->document_content->materials_and_equipments) as $data)
                                            <input type="text" name="materials_and_equipments[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}} >
                                        @endforeach
                                    @else
                                        <input type="text" name="materials_and_equipments[]" class="myclassname">
                                    @endif

                                    <div id="materialsdiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Materials and Equipments' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text"
                                            name="materials_and_equipments_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="procedure">Procedure</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    <textarea name="procedure" id="summernote" {{Helpers::isRevised($document->stage)}} >{{ $document->document_content->procedure }}</textarea>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Procedure' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @foreach ($history as $tempHistory)
                                @if (Auth::user()->role != 3)
                                    {{-- Add Comment  --}}
                                    <div class="comment">
                                        <div>
                                            <input class="input-field" type="text" name="procedure_comment">
                                        </div>
                                        <div class="button">Add Comment</div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="reporting" id="newreport">
                                        Reporting<button type="button" id="reportingbtadd" name="button" {{Helpers::isRevised($document->stage)}}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->reporting))
                                        @foreach (unserialize($document->document_content->reporting) as $data)
                                            <input type="text" name="reporting[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}}>
                                        @endforeach
                                    @else
                                        <input type="text" name="reporting[]" class="myclassname">
                                    @endif

                                    <div id="reportingdiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'Reporting' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="reporting_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="references" id="references">
                                        References<button type="button" id="referencesbtadd" name="button" {{Helpers::isRevised($document->stage)}}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->references))
                                        @foreach (unserialize($document->document_content->references) as $data)
                                            <input type="text" name="references[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}}>
                                        @endforeach
                                    @else
                                        <input type="text" name="references[]" class="myclassname">
                                    @endif

                                    <div id="referencesdiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'References' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach

                                   
                                    
                                   
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="references_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif

                            {{-- <div class="col-md-12">   --Aditya
                                <div class="group-input">
                                    <label for="annexure">
                                        Annexure<button type="button" name="ann" id="annexurebtnadd">+</button>
                                    </label>
                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                    <table class="table-bordered table" id="annexure">
                                        <thead>

                                            <tr>
                                                <th class="sr-num">Sr. No.</th>
                                                <th class="annx-num">Annexure No.</th>
                                                <th class="annx-title">Title of Annexure</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if (!empty($annexure))
                                                @foreach (unserialize($annexure->sno) as $key => $data)
                                                    <tr>
                                                        <td><input type="text" name="serial_number[]"
                                                                value="{{ $data }}"></td>
                                                        <td><input type="text" name="annexure_number[]"
                                                                value="{{ unserialize($annexure->annexure_no)[$key] }}">
                                                        </td>
                                                        <td><input type="text" name="annexure_data[]"
                                                                value="{{ unserialize($annexure->annexure_title)[$key] }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <div id="annexurediv"></div>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ann" id="ann">
                                        Annexure<button type="button" id="annbtadd" name="button" {{Helpers::isRevised($document->stage)}}>+</button>
                                    </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                    @if (!empty($document->document_content->ann))
                                        @foreach (unserialize($document->document_content->ann) as $data)
                                            <input type="text" name="ann[]" class="myclassname"
                                                value="{{ $data }}" {{Helpers::isRevised($document->stage)}}>
                                        @endforeach
                                    @else
                                        <input type="text" name="ann[]" class="myclassname">
                                    @endif

                                    <div id="anndiv"></div>
                                    @foreach ($history as $tempHistory)
                                        @if ($tempHistory->activity_type == 'ann' && !empty($tempHistory->comment))
                                            @php
                                                $users_name = DB::table('users')
                                                    ->where('id', $tempHistory->user_id)
                                                    ->value('name');
                                            @endphp
                                            <p style="color: blue">Modify by {{ $users_name }} at
                                                {{ $tempHistory->created_at }}
                                            </p>
                                            <input class="input-field"
                                                style="background: #ffff0061;
                                    color: black;"
                                                type="text" value="{{ $tempHistory->comment }}" disabled>
                                        @endif
                                    @endforeach

                                   
                                    
                                   
                                </div>
                            </div>

                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="ann_comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif
                            {{-- <div class="col-md-12">
                                <div class="group-input">
                                    <label for="test">
                                        Revision History<button type="button" name="reporting2"
                                            onclick="addDocRow('revision')">+</button>
                                    </label>
                                    <div><small class="text-primary">Please mention brief summary</small></div>
                                    <table class="table-bordered table" id="revision">
                                        <thead>
                                            <tr>
                                                <th class="sop-num">SOP Revision No.</th>
                                                <th class="dcrf-num">Change Control No./ DCRF No.</th>
                                                <th class="changes">Changes</th>
                                                //<th class="deleteRow">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            @if (Auth::user()->role != 3)

                                {{-- Add Comment  --}}
                                <div class="comment">
                                    <div>
                                        <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                            {{ date('d-M-Y h:i:s') }}</p>

                                        <input class="input-field" type="text" name="comment">
                                    </div>
                                    <div class="button">Add Comment</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                <div id="annexures" class="tabcontent">
                    <div class="input-fields">
                        @if (!empty($document->document_content->annexuredata))
                            @foreach (unserialize($document->document_content->annexuredata) as $data)
                                <label>Annexure</label>
                                <textarea class="summernote" name="annexuredata[]">{{ $data }}</textarea>
                            @endforeach
                        @else
                            <div class="group-input">
                                <label for="annexure-1">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-1"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-2">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-2"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-3">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-3"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-4">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-4"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-5">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-5"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-6">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-6"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-7">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-7"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-8">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-8"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-9">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-9"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-10">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-10"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-11">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-11"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-12">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-12"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-13">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-13"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-14">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-14"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-15">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-15"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-16">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-16"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-17">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-17"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-18">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-18"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-19">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-19"></textarea>
                            </div>
                            <div class="group-input">
                                <label for="annexure-20">Annexure</label>
                                <textarea class="summernote" name="annexuredata[]" id="annexure-20"></textarea>
                            </div>

                        @endif


                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                <div id="distribution-retrieval" class="tabcontent">
                    <div class="orig-head">
                        Distribution & Retrieval
                    </div>
                    <div class="col-md-12 input-fields">
                        <div class="group-input">

                            <label for="distribution" id="distribution">
                                Distribution & Retrieval<button type="button" id="distributionbtnadd" name="button">+</button>
                            </label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                            @if (!empty($document->document_content->distribution))
                                @foreach (unserialize($document->document_content->distribution) as $data)
                                    <input type="text" name="distribution[]" class="myclassname"
                                        value="{{ $data }}">
                                @endforeach
                            @else
                                <input type="text" name="distribution[]" class="myclassname">
                            @endif

                            <div id="distributiondiv"></div>
                            @foreach ($history as $tempHistory)
                                @if ($tempHistory->activity_type == 'distribution' && !empty($tempHistory->comment))
                                    @php
                                        $users_name = DB::table('users')
                                            ->where('id', $tempHistory->user_id)
                                            ->value('name');
                                    @endphp
                                    <p style="color: blue">Modify by {{ $users_name }} at
                                        {{ $tempHistory->created_at }}
                                    </p>
                                    <input class="input-field"
                                        style="background: #ffff0061;
                            color: black;"
                                        type="text" value="{{ $tempHistory->comment }}" disabled>
                                @endif
                            @endforeach

                           
                            
                           
                        </div>
                    </div>

                    @if (Auth::user()->role != 3)

                        {{-- Add Comment  --}}
                        <div class="comment">
                            <div>
                                <p class="timestamp" style="color: blue">Modify by {{ Auth::user()->name }} at
                                    {{ date('d-M-Y h:i:s') }}</p>

                                <input class="input-field" type="text" name="distribution_comment">
                            </div>
                            <div class="button">Add Comment</div>
                        </div>
                    @endif
                    {{-- <div class="input-fields">
                        <div class="group-input">
                            <label for="distriution_retrieval">
                                Distribution & Retrieval
                                <button type="button" name="agenda"
                                    onclick="addDistributionRetrieval('distribution-retrieval-grid')">+</button>
                            </label>
                            <div class="table-responsive retrieve-table">
                                <table class="table table-bordered" id="distribution-retrieval-grid">
                                    <thead>
                                        <tr>
                                            <th class="copy-name">Document Title</th>
                                            <th class="copy-name">Document Number</th>
                                            <th class="copy-name">Document Printed By</th>
                                            <th class="copy-name">Document Printed on</th>
                                            <th class="copy-num">Number of Print Copies</th>
                                            <th class="copy-name">Issuance Date</th>
                                            <th class="copy-name">Issued To </th>
                                            <th class="copy-long">Department/Location</th>
                                            <th class="copy-num">Number of Issued Copies</th>
                                            <th class="copy-long">Reason for Issuance</th>
                                            <th class="copy-name">Retrieval Date</th>
                                            <th class="copy-name">Retrieved By</th>
                                            <th class="copy-name">Retrieved Person Department</th>
                                            <th class="copy-num">Number of Retrieved Copies</th>
                                            <th class="copy-long">Reason for Retrieval</th>
                                            <th class="copy-long">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($print_history)
                                            @foreach ($print_history as $print_historys)
                                                <tr>
                                                    <td class="copy-name">{{ $document->document_name }}</td>
                                                    <td class="copy-name">{{ $document->division_name }}
                                                        /{{ $document->document_type_name }} /{{ $year }}
                                                        /SOP-000{{ $document->id }}</td>
                                                    <td class="copy-name">{{ $print_historys->user_name }}</td>
                                                    <td class="copy-name">{{ $print_historys->created_at }}</td>
                                                    <td class="copy-num">1</td>
                                                    <td class="copy-name">{{ $document->created_at }}</td>
                                                    <td class="copy-name">{{ $document->originator_name }}</td>
                                                    <td class="copy-name">{{ $document->dept_name }}</td>
                                                    <td class="copy-num">12</td>
                                            <td class="copy-long">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                Cumque eum neque quam.</td>
                                            <td class="copy-name">29-12-2023</td>
                                            <td class="copy-name">Amit Patel</td>
                                            <td class="copy-num">12</td>
                                            <td class="copy-long">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum
                                                maiores reiciendis sint.</td>
                                            <td class="copy-long">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                Expedita culpa ab assumenda delectus beatae facilis itaque deserunt harum, quae
                                                doloribus!</td>
                                                </tr>
                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>

                {{-- <div id="print-download" class="tabcontent">
                    <div class="orig-head">
                        Print Permissions
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="person-print">Person Print Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Person</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                Amit Patel
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                6543
                                            </td>
                                            <td class="permission">
                                                432
                                            </td>
                                            <td class="permission">
                                                123
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="group-print">Group Print Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Groupd</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                QA
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="orig-head">
                        Download Permissions
                    </div>
                    <div class="input-fields">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="person-print">Person Download Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Groups</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                QA
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="group-print">Group Download Permission</label>
                                    <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <table class="table-bordered table">
                                        <thead>
                                            <th class="person">Person</th>
                                            <th class="permission">Daily</th>
                                            <th class="permission">Weekly</th>
                                            <th class="permission">Monthly</th>
                                            <th class="permission">Quarterly</th>
                                            <th class="permission">Annually</th>
                                        </thead>
                                        <tbody>
                                            <td class="person">
                                                Amit Patel
                                            </td>
                                            <td class="permission">1</td>
                                            <td class="permission">
                                                54
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                            <td class="permission">
                                                765
                                            </td>
                                            <td class="permission">
                                                654
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div> --}}

                <div id="sign" class="tabcontent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Originated By 
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Review')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Review Proposed On
                                </div>
                                <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Originated On 
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Approval')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Document Reuqest Approved On
                                </div>
                                <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Document Writing Completed By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'In-Approval')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Document Writing Completed On
                                </div>
                                <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Reviewd By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'Review-Submit')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Reviewed On
                                </div>
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Approved By
                                </div>
                                @php
                                    $inreview = DB::table('stage_manages')
                                        ->join('users', 'stage_manages.user_id', '=', 'users.id')
                                        ->select('stage_manages.*', 'users.name as user_name')
                                        ->where('document_id', $document->id)
                                        ->where('stage', 'Approval-Submit')
                                        ->get();

                                @endphp
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->user_name }}</div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Approved On
                                </div>
                                @foreach ($inreview as $temp)
                                    <div class="name">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Training Completed By
                                </div>
                                <div class="name">Amit Patel</div>
                                <div class="name">Amit Patel</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-names">
                                <div class="orig-head">
                                    Training Completed On
                                </div>
                                <div class="name">29-12-2023 11:12PM</div>
                                <div class="name">29-12-2023 11:12PM</div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="button-block">
                        <button type="submit" name="submit" value="save" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>

                @if ($document->stage < 8)
                    {{-- <div class="form-btn-bar">
                        <div class="container-fluid header-bottom bottom-pr-links">
                            <div class="container">
                                <div class="bottom-links">
                                    <div>
                                        <button type="submit" name="submit" value="save">Save</button>
                                    </div>
                                    <div>
                                        <a href="{{ route('documents.index') }}"> <button
                                                type="submit">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endif

            </form>
        </div>
    </div>


    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>


    <script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addButton').click(function() {
                var sourceValue = $('#sourceField').val(); // Get the value from the source field
                var targetField = $(
                    '.targetField'); // The target field where the data will be added and selected

                // Create a new option with the source value
                var newOption = $('<option>', {
                    value: sourceValue,
                    text: sourceValue
                });

                // Append the new option to the target field
                targetField.append(newOption);

                // Set the new option as selected
                newOption.prop('selected', true);
                $('#sourceField').val('');
            });
        });
    </script>

    <script>
        function openData(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";

            // Find the index of the clicked tab button
            const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

            // Update the currentStep to the index of the clicked tab
            currentStep = index;
        }

        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".tablinks");
        const steps = document.querySelectorAll(".tabcontent");
        let currentStep = 0;

        function nextStep() {
            // Check if there is a next step
            if (currentStep < steps.length - 1) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show next step
                steps[currentStep + 1].style.display = "block";

                // Add active class to next button
                stepButtons[currentStep + 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep++;
            }
        }

        function previousStep() {
            // Check if there is a previous step
            if (currentStep > 0) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show previous step
                steps[currentStep - 1].style.display = "block";

                // Add active class to previous button
                stepButtons[currentStep - 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep--;
            }
        }
    </script>
@endsection
