<div class="form-container"> 
    <h2 class='header'>Create a new Employee</h2>
    <form action="#" method="POST" class="form">
        <label for="input-name">Name:</label>
        <input type="text" name="name" class="form__input" id="input-name">
        <label for="input-lname">Last name:</label>
        <input type="text" name="surname" class="form__input" id="input-lname">
        <label for="input-exp">Experience:</label>
        <input type="number" name="experience" class="form__input" id="input-exp" value="0" min="0" max="40">
        <label for="input-salary">Salary:</label>
        <input type="number" name="salary" class="form__input" id="input-salary" value="100" min="100" max="1000">
        <label for="input-vd">Vacation Days:</label>
        <input type="number" name="vacation-days" class="form__input" id="input-vd" value="0" min="0" max="30">
        <label for="input-gstation">Gas Station:</label>
        <select name="gstation" id="input-gstation" class="form__select">
            <option value="1">Pumpa A</option>
            <option value="2">Pumpa B</option>
            <option value="3">Pumpa C</option>
        </select>
        <input type="submit" name="new-employee" value="Create" class="form__input">
    </form>
</div>