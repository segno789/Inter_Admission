<div class="dashboard-wrapper">
    <div class="left-sidebar">


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Download Result Cards:
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">

                            <form class="form-horizontal no-margin" action="/result/downloadresultcard" method="post" enctype="multipart/form-data" name="myform" id="myform">

                                <div class="control-group">
                                    <label class="control-label span1" >
                                        Roll Number:
                                    </label>
                                    <div class="controls controls-row">
                                        <input class="span3"  type="text" id="rno" style="text-transform: uppercase;width: 200px;" name="rno" maxlength="6" required  >
                                        <input type="hidden" name="isconrollerstmp" value="1">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label span1" >
                                        Class :
                                    </label>
                                    <div class="controls controls-row">
                                        <select id="cls" class="dropdown span6"  name="cls" style="width: 200px;">

                                            <option value='12' selected='selected'>12th</option>
                                            <option value='11'>11th</option>

                                        </select>                                            
                                    </div>
                                </div>

                                <div class="span6">
                                    <button type="submit"  name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                        Downlaod Card
                                    </button>

                                </div> 
                            </form>



                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
</div>
</div>

