<div class="phonebook-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-title">
            <i class="fa fa-phone"></i><span><b>204</b>Phonebook</span>
        </div>
        <div class="sidebar-nav">
            <ul class="nav nav-pills phonebook-nav">
              <li class="active"><a href="#tab-firstAiders" role="tab" data-toggle="tab">First Aiders</a></li>
              <li><a href="#tab-hospitals" role="tab" data-toggle="tab">Hospitals</a></li>
              <li><a href="#tab-lrcCenters" role="tab" data-toggle="tab">LRC Centers</a></li>
              <li><a href="#tab-bloodBanks" role="tab" data-toggle="tab">Blood Banks</a></li>
              <li><a href="#tab-organizations" role="tab" data-toggle="tab">Organizations</a></li>
              <li class="seperator"></li>
              <li><a class="dial-item-btn" data-dial='["05458204"]'><i class="fa fa-phone"></i>&nbsp;&nbsp;<b>O.R.</b></a></li>
              <li><a class="dial-item-btn" data-dial='["140"]'><i class="fa fa-phone"></i>&nbsp;&nbsp;<b>206</b></a></li>
            </ul>
        </div>
        <button class="btn btn-header btn-close light no-border" onclick="hidePhonebookSidebar()"><i class="fa fa-times"></i></button>
    </div>
    <div class="sidebar-body container-fluid">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="tab-firstAiders">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li role="presentation" class="active"><a data-filter="favorite">Current Members</a></li>
                    <li role="presentation" class=""><a data-filter="favorite">Ex Members</a></li>
                </ul>
                <table id="table-FirstAiders" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">Ex Member</th>
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
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]'>
                            <td class="hidden">0</td>
                            <td class="hidden">1</td>
                            <td><b>Wakim</b></td>
                            <td><b>Mansour</b></td>
                            <td>Rondpoint</td>
                            <td>2010</td>
                            <td>204</td>
                            <td>
                                <span class="label label-primary">RM</span>
                                <span class="label label-success"><i class="fa fa-car"></i></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-hospitals">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li role="presentation" class="active"><a data-filter="favorite"><i class="fa fa-star"></i></a></li>
                    <li role="presentation"><a data-filter="100">100</a></li>
                    <li role="presentation"><a data-filter="200">200</a></li>
                    <li role="presentation"><a data-filter="300">300</a></li>
                    <li role="presentation"><a data-filter="400">400</a></li>
                    <li role="presentation"><a data-filter="500">500</a></li>
                    <li role="presentation"><a data-filter="600">600</a></li>
                    <li role="presentation"><a data-filter="700">700</a></li>
                    <li role="presentation"><a data-filter="nursing">Nursing Homes</a></li>
                    <li role="presentation"><a data-filter="other">Other</a></li>
                </ul>
                <table id="table-Hospitals" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">District</th>
                            <th width="100">Sector</th>
                            <th>Code</th>
                            <th>Hospital Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]'>
                            <td class="hidden">200</td>
                            <td><b>204</b></td>
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
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]'>
                            <td><b>204</b></td>
                            <td><b>Beit Mery</b></td>
                            <td>284, 285, 286, 287, 288</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-bloodBanks">
                <div class="m-t-md"></div>
                <table id="table-BloodBanks" class="display table phonebook-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="150">Sector</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]'>
                            <td><b>204</b></td>
                            <td><b>Beit Mery</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-organizations">
                <ul class="nav nav-pills phonebook-filter-pills m-t-sm m-b-sm">
                    <li><h4 class="sub-title">Favorites</h4></li>

                    <li role="presentation" class="active"><a data-filter="favorite"><i class="fa fa-star"></i></a></li>
                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Emergency Contacts <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="combo">
                              <a class="first" data-filter="100">Civil Defense</a>
                              <a class="second dial-item-btn" data-dial='["125"]'><i class="fa fa-phone"></i>&nbsp;125</a>
                            </li>
                            <li class="combo">
                              <a class="first" data-filter="100">Fire Department</a>
                              <a class="second dial-item-btn" data-dial='["175"]'><i class="fa fa-phone"></i>&nbsp;175</a>
                            </li>
                            <li class="combo">
                              <a class="first" data-filter="100">ISF Police</a>
                              <a class="second dial-item-btn" data-dial='["112"]'><i class="fa fa-phone"></i>&nbsp;112</a>
                            </li>
                            <li class="combo">
                              <a class="first" data-filter="100">Airport</a>
                              <a class="second dial-item-btn" data-dial='["150"]'><i class="fa fa-phone"></i>&nbsp;150</a>
                            </li>
                            <li><a data-filter="500">Ports</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Media Contacts <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a data-filter="500">Radio &amp; Television</a></li>
                            <li><a data-filter="500">Journals</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Medical Contacts <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a data-filter="500">Medical Centers</a></li>
                            <li><a data-filter="500">Insurance Companies</a></li>
                        </ul>
                    </li>

                    <li role="presentation"><a data-filter="other">Other Contacts</a></li>
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
                        <tr class="phonebook-row dial-item-btn" data-dial='["03032033", "04972665"]'>
                            <td class="hidden">restaurant</td>
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