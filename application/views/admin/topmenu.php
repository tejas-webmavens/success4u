<!--Topbar  -->
 
        <header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a href="<?php echo  base_url().$this->uri->segments[1];?>">
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                   <?php if(isset($this->uri->segments[1])){?>
                    <li class="breadcrumb-active"><a href="<?php echo  base_url().$this->uri->segments[1];?>">Dashboard</a></li>
                    <?php }if(isset($this->uri->segments[2])){?>
                    <li class="breadcrumb-link"> <a href="<?php echo  base_url().$this->uri->segments[1].'/'.$this->uri->segments[2];?>"><?php echo  ucwords($this->uri->segments[2]); ?></a> </li>
                    <?php }if(isset($this->uri->segments[3])){?>
                    <li class="breadcrumb-current-item"><?php echo  ucwords($this->uri->segments[3]); ?></li>
                    <?php } ?>
                </ol>
            </div>
           <!--  <div class="topbar-right">
                <div class="ib topbar-dropdown">
                    <label for="topbar-multiple" class="control-label">Reporting Period</label>
                    <select id="topbar-multiple" class="hidden">
                        <optgroup label="Filter By:">
                            <option value="1-1">Last 30 Days</option>
                            <option value="1-2" selected="selected">Last 60 Days</option>
                            <option value="1-3">Last Year</option>
                        </optgroup>
                    </select>
                </div>
                <div class="ml15 ib va-m" id="sidebar_right_toggle">
                    <div class="navbar-btn btn-group btn-group-number mv0">
                        <button class="btn btn-sm btn-default btn-bordered prn pln">
                            <i class="fa fa-bar-chart fs22 text-default"></i>
                        </button>
                        <button class="btn btn-primary btn-sm btn-bordered hidden-xs"> 3</button>
                    </div>
                </div>
            </div> -->
        </header>
        <!--  /Topbar -->