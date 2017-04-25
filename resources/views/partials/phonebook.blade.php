<div class="phonebook-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-title">
            <i class="fa fa-phone"></i><span><b>204</b>Phonebook</span>
        </div>
        <div class="sidebar-nav">
            <ul class="nav nav-pills phonebook-nav">
              <li class="active"><a href="#tab-firstAiders" role="tab" data-toggle="tab">First Aiders</a></li>
              <li><a href="#tab-medicalCenters" role="tab" data-toggle="tab">Medical Centers</a></li>
              <li><a href="#tab-lrcCenters" role="tab" data-toggle="tab">LRC Centers</a></li>
              <li><a href="#tab-organizations" role="tab" data-toggle="tab">Organizations</a></li>
              <li class="seperator"></li>
              <li><a class="dial-item-btn" data-dial='["05458204"]' data-dial-name="O.R."><i class="fa fa-phone"></i>&nbsp;&nbsp;<b>O.R.</b></a></li>
              <li><a class="dial-item-btn" data-dial='["140"]' data-dial-name="206 (Jal el Dib)"><i class="fa fa-phone"></i>&nbsp;&nbsp;<b>206</b></a></li>
            </ul>
        </div>
        <button class="btn btn-header btn-close light no-border" onclick="hidePhonebookSidebar()"><i class="fa fa-times"></i></button>
    </div>
    <div class="sidebar-body container-fluid">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="tab-firstAiders">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li role="presentation" class="active"><a data-filter="0" data-filter-column="0" class="table-filter-btn">Current Members</a></li>
                    <li role="presentation" class=""><a data-filter="1" data-filter-column="0" class="table-filter-btn">Ex Members</a></li>
                </ul>
                <table id="table-FirstAiders" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">Ex Member</th>
                            <th class="hidden">Regional Manager</th>
                            <th class="hidden">Ambulance Driver</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th data-orderable="false">Nickname</th>
                            <th>Promo</th>
                            <th data-orderable="false">Address</th>
                            <th data-orderable="false">More Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $firstAider)
                        <tr class="phonebook-row dial-item-btn" data-dial='{{ json_encode($firstAider->phone_numbers) }}' data-dial-name="{{ $firstAider->full_name }}">
                            <td class="hidden">{{ $firstAider->is_ex }}</td>
                            <td class="hidden">{{ $firstAider->is_rm }}</td>
                            <td class="hidden">{{ $firstAider->is_amb }}</td>
                            <td><b>{{ $firstAider->last_name }}</b></td>
                            <td><b>{{ $firstAider->first_name }}</b></td>
                            <td>{{ $firstAider->nickname }}</td>
                            <td>{{ $firstAider->promo }}</td>
                            <td>{{ $firstAider->location }}</td>
                            <td>
                                @if($firstAider->is_rm)
                                <span class="label label-primary" title="Regional Manager">RM</span>
                                @endif
                                @if($firstAider->is_amb)
                                <span class="label label-success" title="Ambulance Driver"><i class="fa fa-car"></i></span>
                                @endif
                                @if($firstAider->is_ami)
                                <span class="label label-default" title="Ami du Centre"><i class="fa fa-users"></i></span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-medicalCenters">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li role="presentation" class="active"><a data-filter="favorite" data-filter-column="0" class="table-filter-btn"><i class="fa fa-star"></i></a></li>
                    <li role="presentation"><a data-filter="hospital" data-filter-column="0" class="table-filter-btn">Hospitals</a></li>
                    <li role="presentation"><a data-filter="nursing-home" data-filter-column="0" class="table-filter-btn">Nursing Homes</a></li>
                    <li role="presentation"><a data-filter="blood-bank" data-filter-column="0" class="table-filter-btn">Blood Banks</a></li>
                </ul>
                <table id="table-MedicalCenters" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">Category</th>
                            <th width="100">Sector</th>
                            <th>Code</th>
                            <th>Hospital Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]' data-dial-name="MEH">
                            <td class="hidden">hospital</td>
                            <td><b>204h</b></td>
                            <td><b>MEH</b></td>
                            <td>Middle East Institute of Health</td>
                        </tr>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]' data-dial-name="MEH">
                            <td class="hidden">nursing-home</td>
                            <td><b>204nh</b></td>
                            <td><b>MEH</b></td>
                            <td>Middle East Institute of Health</td>
                        </tr>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]' data-dial-name="MEH">
                            <td class="hidden">blood-bank</td>
                            <td><b>204bb</b></td>
                            <td><b>MEH</b></td>
                            <td>Middle East Institute of Health</td>
                        </tr>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]' data-dial-name="MEH">
                            <td class="hidden">favorite</td>
                            <td><b>204fav</b></td>
                            <td><b>MEH</b></td>
                            <td>Middle East Institute of Health</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-lrcCenters">
                <div class="m-t-md"></div>
                <table id="table-LrcCenters" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="150">Code</th>
                            <th>District</th>
                            <th>Ambulances</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]' data-dial-name="204 (Beit Mery)">
                            <td><b>204</b></td>
                            <td><b>Beit Mery</b></td>
                            <td>284, 285, 286, 287, 288</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-organizations">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li class="nav-pills-title"><h4 class="sub-title">Favorites</h4></li>

                    <li role="presentation" class="active"><a data-filter="favorite" data-filter-column="0" class="fav-title table-filter-btn"><i class="fa fa-star"></i></a></li>
                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Emergency <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="combo">
                              <a data-filter="civil-defense" data-filter-column="0" class="sub first table-filter-btn">Civil Defense</a>
                              <a class="second dial-item-btn" data-dial='["125"]' data-dial-name="Civil Defense Hotline"><i class="fa fa-phone"></i>&nbsp;125</a>
                            </li>
                            <li class="combo">
                              <a data-filter="fire-department" data-filter-column="0" class="sub first table-filter-btn">Fire Department</a>
                              <a class="second dial-item-btn" data-dial='["175"]' data-dial-name="Fire Department Hotline"><i class="fa fa-phone"></i>&nbsp;175</a>
                            </li>
                            <li class="combo">
                              <a data-filter="isf-police" data-filter-column="0" class="sub first table-filter-btn">ISF Police</a>
                              <a class="second dial-item-btn" data-dial='["112"]' data-dial-name="ISF Police Hotline"><i class="fa fa-phone"></i>&nbsp;112</a>
                            </li>
                            <li class="combo">
                              <a data-filter="airport" data-filter-column="0" class="sub first table-filter-btn">Airport</a>
                              <a class="second dial-item-btn" data-dial='["150"]' data-dial-name="Airport Hotline"><i class="fa fa-phone"></i>&nbsp;150</a>
                            </li>
                            <li><a data-filter="ports" data-filter-column="0" class="sub table-filter-btn">Ports</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Media <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a data-filter="radio-tv" data-filter-column="0" class="sub table-filter-btn">Radio &amp; Television</a></li>
                            <li><a data-filter="journals" data-filter-column="0" class="sub table-filter-btn">Journals</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Medical <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a data-filter="204-doctors" data-filter-column="0" class="sub table-filter-btn">204 Doctors</a></li>
                            <li><a data-filter="medical-centers" data-filter-column="0" class="sub table-filter-btn">Medical Centers</a></li>
                            <li><a data-filter="insurance-companies" data-filter-column="0" class="sub table-filter-btn">Insurance Companies</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Miscellaneous <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a data-filter="restaurants" data-filter-column="0" class="sub table-filter-btn">Restaurants</a></li>
                            <li><a data-filter="other-contacts" data-filter-column="0" class="sub table-filter-btn">Other Contacts</a></li>
                        </ul>
                    </li>
                </ul>
                <table id="table-Organizations" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">Category</th>
                            <th>Name</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665", "03032033", "04972665", "03032033", "04972665", "03032033", "04972665", "03032033", "04972665", "03032033", "04972665", "03032033", "04972665"]' data-dial-name="Crepaway (Broumana)">
                            <td class="hidden">restaurants</td>
                            <td><b>Crepaway</b></td>
                            <td>Broumana</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDial" aria-hidden="true" id="modalDial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">DIAL <b></b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 dial-buttons"></div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-default btn-ip-phone" data-ip-address="">OR1<br><img src="{{ asset('/images/ip-phone.png') }}" /></button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-default btn-ip-phone" data-ip-address="">OR2<br><img src="{{ asset('/images/ip-phone.png') }}" /></button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-default btn-ip-phone" data-ip-address="">OR3<br><img src="{{ asset('/images/ip-phone.png') }}" /></button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-default btn-ip-phone" data-ip-address="">OR4<br><img src="{{ asset('/images/ip-phone.png') }}" /></button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>