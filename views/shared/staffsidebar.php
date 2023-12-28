<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar" class="navbar-dark bg-dark">
        <div class="sidebar-header">
            <h2>Staff Panel</h2>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="<?= URLROOT;?>/Staff/dashboard"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
            </li>
            <li>
                <a href="<?= URLROOT;?>/Parcel/addCourier"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Courier</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-shipping-fast"></i>&nbsp;&nbsp;Courier View</a>
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
                <a href="<?= URLROOT;?>/Parcel/search"><i class="fas fa-search"></i>&nbsp;&nbsp;Search Courier</a>
            </li>
        </ul> 
    </nav>