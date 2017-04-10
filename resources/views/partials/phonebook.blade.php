<div class="phonebook-sidebar open">
    <div class="sidebar-header">
        <div class="sidebar-title">
            <i class="fa fa-phone"></i><span><b>204</b>Phonebook</span>
        </div>
        <div class="sidebar-nav">
            <ul class="nav nav-pills">
              <li class="active"><a href="#">First Aiders</a></li>
              <li><a href="#">Hospitals</a></li>
              <li><a href="#">LRC Centers</a></li>
              <li><a href="#">Blood Banks</a></li>
              <li><a href="#">Organizations</a></li>
            </ul>
        </div>
        <button class="btn btn-header btn-close light" onclick="hidePhonebookSidebar()"><i class="fa fa-times"></i></button>
    </div>
    <div class="sidebar-body">
        <table id="phonebookTable" class="display table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th data-orderable="false">Nickname</th>
                    <th>Promo</th>
                    <th data-orderable="false">Address</th>
                    <th data-orderable="false"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Wakim</b></td>
                    <td><b>Mansour</b></td>
                    <td>Rondpoint</td>
                    <td>2010</td>
                    <td>204</td>
                    <td>
                        <button class="btn btn-default dial-item-btn" data-dial="03032033">03 032 033</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>