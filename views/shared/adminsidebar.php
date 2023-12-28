<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar" class="navbar-dark bg-dark">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="<?= URLROOT;?>/Admin/dashboard"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
            </li>
            <li>
                <a href="<?= URLROOT;?>/Branch/branchDetails"><i class="fas fa-code-branch"></i>&nbsp;&nbsp;Branches</a>
            </li>
            <li>
                <a href="<?= URLROOT;?>/Staff/staffDetails"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Staffs</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-shipping-fast"></i>&nbsp;&nbsp;Courier</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totalPickup">Pickup</a>
                    </li>
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totalShipped">Shipped</a>
                    </li>
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totalIn-transit">In-transit</a>
                    </li>
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totalArrived">Arrived</a>
                    </li>
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totaloutForDelivery">Out For Delivery</a>
                    </li>
                    <li>
                        <a href="<?= URLROOT;?>/Parcel/details?type=totalDelivered">Delivered</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?=URLROOT;?>/Admin/viewReport"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;Reports</a>
            </li>
        </ul> 
    </nav>