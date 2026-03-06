<form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="col-md-6">
            <label for="validationCustom04" class="form-label">How long has your business been operating? *</label>
            <select class="form-select form-control" name="business_year" id="business_year" required>
                <!-- <option selected disabled value="">Choose...</option> -->
                <option>Less than 1 Year</option>
                <option>1 - 3 Years</option>
                <option>3 - 5 Years</option>
                <option>5+ Years</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="validationCustom04" class="form-label">Field of Business *</label>
            <select class="form-select form-control" name="field_of_business" id="field_of_business" required>
                <!-- <option selected disabled value="">Choose...</option> -->
                <option>Food & Beverage / Restaurants</option>
                <option>Retail</option>
                <option>Hospitality</option>
                <option>Construction</option>
                <option>Transportation & Logistics</option>
                <option>Healthcare</option>
                <option>Technology</option>
                <option>Education</option>
                <option>Other</option>

            </select>
        </div>
        <div class="col-md-12" style="margin-bottom: 75px;margin-top: 10px">
            <textarea class="form-select form-control" id="other-text" name="other_field" rows="3" placeholder="Please specify the field of business..." style="display:none;"></textarea>
        </div>
    </div>

</form>