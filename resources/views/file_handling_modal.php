<div class="modal" id="myFilehanding">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">File Handing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <form name="myFilehandingFrm">
                            <div class="form-group">
                                <label class="control-label " for="name">
                                    Name
                                </label>
                                <input class="form-control" id="e_file_name" name="name" type="text" />
                            </div>
                            <div class="form-group ">
                                <label class="control-label requiredField" for="email">
                                    Email
                                    <span class="asteriskField">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="e_file_email" name="email" type="text" />
                            </div>
                            <div class="form-group ">
                                <label class="control-label " for="phone">
                                    phone
                                </label>
                                <input class="form-control" id="e_file_phone" name="phone" type="text" />
                            </div>

                            <div class="form-group ">
                                <label class="control-label " for="message">
                                    Message
                                </label>
                                <textarea class="form-control" cols="40" id="e_file_message" name="message" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input type='hidden' id='hiddenIds' name='hiddenIds'>
                                    <a class="btn btn-primary btnupdate" name="submit">
                                        Submit
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
