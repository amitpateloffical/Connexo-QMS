@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ====================================== CHANGE CONTROL VIEW ======================================= --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button>
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/extension-audit-trial', $data->id) }}"> Audit Trail </a> </button>
                        @if ($data->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Ext Approve
                            </button>
                        @endif
                        <a class="text-white button_theme1" href="{{ url('rcms/qms-dashboard') }}">
                            Exit
                        </a>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="active bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Open State</div>
                            @else
                                <div class="">Open State</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Pending Approval
                                </div>
                            @else
                                <div class="">Pending Approval
                                </div>
                            @endif
                            @if ($data->stage <= 3)
                                @if ($data->stage >= 3)
                                    <div class="bg-danger">Closed-Done</div>
                                @else
                                    <div class="">Closed-Done</div>
                                @endif
                            @else
                                @if ($data->stage >= 4)
                                    <div class="active bg-danger">Closed-Rejected</div>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Extension</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')"> QA Approval</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')"> Activity Log</button>
                    </div>
                    <form action="{{ route('extension.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="step-form">
                            <!--  Extension Details Tab content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sub-head">Extension Details</div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number">Record Number</label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}/Extention/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code">Division Code</label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator">Initiator</label>
                                                {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due">Date of Initiation</label>

                                                <input disabled type="text" name="intiation_date"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Current Parent Due Date <span
                                                        class="text-danger"></span></label>
                                                <input disabled type="text" name="intiation_date"
                                                    value="{{ Helpers::getdateFormat($data->due_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Revised Due Date <span
                                                        class="text-danger"></span></label>
                                                <input disabled type="text" name="intiation_date"
                                                    value="{{ Helpers::getdateFormat($data->revised_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Desccription">Short Description <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="short_description"
                                                    value="{{ $data->short_description }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Justification of Extention">Justification of Extention</label>
                                                <textarea name="justification">{{ $data->justification }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Extention Attachments">Extention Attachments </label>
                                                <input type="file" id="myfile" name="extention_attachment[]"
                                                    multiple>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Extention Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="extention_attachment">
                                                            @if ($data->extention_attachment)
                                                            @foreach(json_decode($data->extention_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                       @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="extention_attachment[]"
                                                                oninput="addMultipleFiles(this, 'extention_attachment')" multiple>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approver">Approver</label>
                                                <select id="select-state" placeholder="Select..." name="approver">
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $value)
                                                        <option {{ $data->approver == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- QA Approval content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Approver Comments">Approver Comments</label>
                                                <textarea name="approver_comments">{{ $data->approver_comments }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="closure-attachments">Closure Attachments</label>
                                                <input type="file" name="closure_attachments[]" multiple>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Closure Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="closure_attachments">
                                                            @if ($data->closure_attachments)
                                                            @foreach(json_decode($data->closure_attachments) as $file)
                                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                       @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="closure_attachments[]"
                                                                oninput="addMultipleFiles(this, 'closure_attachments')" multiple>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">Electronic Signatures</div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted By">Submitted By</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted On">Submitted On</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved By">Ext Approved By</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved On">Ext Approved On</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required By">More Information Required
                                                    By</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required On">More Information Required
                                                    On</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                <div class="static"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log content -->

                            {{-- <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="sub-head">Electronic Signatures</div>
                                        <div class="col-lg-6">
                                            <div class="group-input">

                                                <label for="Original Due Date">Submitted By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 2)
                                                        ->get();
                                                @endphp
                                                @foreach ($submit as $temp)
                                                    <div class="static">{{ $temp->user_name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted On">Submitted On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 2)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled By">Cancelled By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 0)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancelled On">Cancelled On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 0)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved By">Ext Approved By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 3)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Ext Approved On">Ext Approved On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 3)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required By">More Information Required
                                                    By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 1)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="More Information Required On">More Information Required
                                                    On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 1)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected By">Rejected By</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 4)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Rejected On">Rejected On</label>
                                                @php
                                                    $submit = DB::table('c_c_stage_histories')
                                                        ->where('type', 'Extension')
                                                        ->where('doc_id', $data->id)
                                                        ->where('stage_id', 4)
                                                        ->get();
                                                @endphp
                                                @if (count($submit) > 0)
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                @else
                                                    <div class="static">-</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </form>

                </div>
            </div>
            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ url('rcms/send-extension', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ url('rcms/send-reject-extention', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancel-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ url('rcms/send-cancel-extention', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div>
                        </form>
                    </div>
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
                function openCity(evt, cityName) {
                    var i, cctabcontent, cctablinks;
                    cctabcontent = document.getElementsByClassName("cctabcontent");
                    for (i = 0; i < cctabcontent.length; i++) {
                        cctabcontent[i].style.display = "none";
                    }
                    cctablinks = document.getElementsByClassName("cctablinks");
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
                const stepButtons = document.querySelectorAll(".cctablinks");
                const steps = document.querySelectorAll(".cctabcontent");
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
        </div>

    </div>







    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_change', $data->id) }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('q_m_s_divisions')->where('status', 1)->get();
                            @endphp
                            @foreach ($division as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button>
                            @endforeach

                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        <button id="submit-division">Cancel</button>
                        <button id="submit-division" type="submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-reject-extention', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-cancel-extention', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Document Revision</h4>
                </div>
                <form method="{{ url('rcms/child-AT', $data->id) }}" action="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="revision">Choose Change Implementation</label>
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Action Item

                            </label>
                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                Extention
                            </label>

                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                New Document
                            </label>


                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#add-input').click(function() {
                var lastInput = $('.bar input:last');
                var newInput = $('<input type="text" name="review_comment">');
                lastInput.after(newInput);
            });
        });
    </script>
@endsection
