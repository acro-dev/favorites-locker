#TODO

## Index page:
- If user is connected :
    - [x] Redirect to dashboard.
- If user is not connected :
    - [x] Display a description of the web site.
    - [x] Suggest to Sign in.
    - [x] Suggest to Log in.

## Navbar :
- [ ] Make it responsive.

## Logout:
- [x] Unset & destroy session.
- [x] Redirect to home.

## Login form:
- [x] HTML/CSS Form.
    - [x] email + password validation.
    - [x] Set session.
    - [ ] Set cookies.
- [ ] Password lost feature.
- [ ] Username lost feature.

## Signup form:
- [ ] HTML/CSS Form.
- [x] Validation of data.
    - [x] Unique username.
    - [x] Unique email && looks like an email.
    - [x] password have at least 8 caracteres.
    - [x] password confirmation is the same than password.
- [x] Database registration.
    - [x] Set session.
    - [ ] Set cookies.

## Dashboard page:
- [ ] Quick add fav (whith only url and name).
- [ ] Add fav function.
    - [ ] Add name.
    - [ ] Add url.
    - [ ] Add category.
        - [ ] Check if category exist, create one if it doesnt.
        - [ ] Suggest caterogy that allready exist.
    - [ ] Add icon.
        - [ ] Maximum size.
        - [ ] Maximum weight.
- [ ] Remove fav function.
- [ ] Modify favorite.
    - [ ] Change name.
    - [ ] Change url.
    - [ ] Change icon.
    - [ ] Change catergory.
- [ ] Sort fav:
    - [ ] By category.
    - [ ] By name.
    - [ ] By creation_date.
- [ ] Responsive listing of fav.
- [ ] Display by name or by icon if icon is set.
    - [ ] If displayed by icon whithout icon set => display placeholder.

## Profile page:
- [ ] Change username.
    - [ ] Verify unicity.
    - [ ] Put change in database.
- [ ] Change email.
    - [ ] Verify if email is valid.
    - [ ] Put change in database.
- [ ] Change password.
    - [ ] Check if password is valid.
    - [ ] Put change in database.
- [ ] Export all favorites into csv.
- [ ] Delete account.