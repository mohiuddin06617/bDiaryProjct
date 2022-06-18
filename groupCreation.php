<div class="page-content">
    <ol class="breadcrumb">

        <li class="active"><a href="userHome.php">Home</a></li>
        <li class="active"><a href="userGroup.php"> User Group Creation</a></li>

    </ol>
    <div class="container-fluid">
        <div class="row mb-xxl" style="padding-top: 10%" id="groupChoiceButton">
            <div class="groupButtonClick text-center" id="groupButtonClick">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <button class="button btn-primary-alt btn-getting btn-lg btn-block" id="groupCreationSelectButton">
                        <h1 class="white-text-color">Create a group <i class="fa fa-group"></i></h1></button>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <h1 class="text-center black-text-color"><b>OR</b></h1>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <button class="button btn-primary-alt btn-getting btn-lg btn-block" id="groupJoinSelectButton"><h1
                                class="white-text-color">Join a Group <i class="ti ti-"></i></h1></button>
                </div>
            </div>
        </div>
        &nbsp;
        <div class="row" id="groupJoinDiv">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="text-center white-text-color">Join a Group <span style="cursor: pointer;"
                                                                                    id="closeGroupJoinDivButton"><i
                                        class="fa fa-close pull-right"></i></span></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <form action="groupSearchResult.php" class="form-horizontal">
                                <div class="form-group mb-n">
                                    <p class="black-text-color">Enter group name or group id to search and join </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-group"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" name="groupNameSearch"
                                               id="groupNameSearch" placeholder="Search Group Name or Group ID Here"
                                               required>
                                    </div>
                                    <div class="list-group groupSearchResult" id="groupSearchResult"></div>
                                </div>
                                &nbsp;
                                <button type="submit" id="groupNameSearchButton"
                                        class="btn btn-primary btn-block btn-lg">Search
                                </button>
                            </form>
                            <span style="font-size: 23px;margin-left: 50%;"><b>OR</b></span>
                            <div class="clearfix">
                                <h3>
                                    <button class="btn btn-info pull-left btn-block btn-lg"
                                            id="groupCreationLinkButton">Click Here to Go Back
                                    </button>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>

                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="groupCreationDiv">
            <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <div class="panel-ctrls" data-actions-container=""></div>
                    <h3 class="text-center" style="color: white;"><i class="fa fa-group"></i> Group Creation <span
                                style="cursor: pointer;" id="closeGroupCreationDivButton"><i
                                    class="fa fa-close pull-right"></i></span></h3>
                </div>
                <div class="panel-body">
                    <div id="groupCreationResult"></div>
                    <div class="my_form">
                        <form name="group_creation_form" method="post" id="group_creation_form"
                              class="form-horizontal row-border my_form"
                              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div id="groupCreationDiv">
                                <div class="row">
                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
                                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                        <label for="groupCreationNameEntry" class="label-input-lg black-text-color">Enter
                                            Group Name Below : </label>
                                        <input type="text" class="form-control input-lg" id="groupCreationNameEntry"
                                               name="groupCreationNameEntry"
                                               placeholder="Enter Your Preferred Group Name Here" required> <!-- For Invalid oninvalid="this.setCustomValidity('Please enter a group name. Group Name Can not be Empty!')"-->
                                        <div id="groupCreationNameResult"></div>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0">
                                        <span id="groupCreationNameEntryError"></span>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-1 col-xs-0"></div>
                                <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                                    <input type="submit"
                                           class="button btn btn-primary btn-lg btn-getting groupCreationButton"
                                           name="groupCreationButton" id="groupCreationButton" value="ENTER">
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="row" id="groupCreationDiv">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="text-center white-text-color">Group Creation <span style="cursor: pointer;" id="closeGroupCreationDivButton"><i class="fa fa-close pull-right"></i></span></h3>
                    </div>
                    <span class="text-primary text-center" style="font-size: 25px;text-align: center;" id="groupCreationResult"></span>
                    <div class="panel-body">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <form class="form-horizontal" id="group_creation_form">
                                <div class="form-group mb-n">
                                        <label for="groupCreationNameEntry">Enter your group name below to create a group</label>
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-navicon"></i>
                                        </span>
                                            <input type="text" class="form-control input-lg" id="groupCreationNameEntry" placeholder="Enter Your Preferred Group Name Here" required>
                                        </div>
                                </div><br>

                                <div class="form-group mb-n">
                                    <label for="possibleGroupMemberSearch">Add Group Member(<b>Must have to add atleast one member</b>)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-group"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" id="newGroupMemberAdd" placeholder="Search With name or email" required>
                                    </div>
                                </div>&nbsp;
                                <button href="<?php /*htmlspecialchars($_SERVER['PHP_SELF'])*/ ?>" type="button" class="btn btn-lg btn-primary btn-block" id="groupCreationButton">Create</button>
                            </form>

                            <span style="font-size: 23px;margin-left: 50%;"><b>OR</b></span>
                            <div class="clearfix">
                                <h3><button class="btn btn-info pull-left btn-block btn-lg" id="groupJoinLinkButton">Click Here to Go back</button></h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->