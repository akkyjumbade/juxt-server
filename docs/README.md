# API Documentation

### App info and version check
```GET``` ```http://beta.connectingalife.com/api```

### Registration
```POST``` ```http://beta.connectingalife.com/register```

Request Headers
```php
Accept: application/json

```

Request Body
```php
  'first_name' => ['required', 'string', 'max:255'],
  'middle_name' => ['nullable', 'string', 'max:255'],
  'last_name' => ['nullable', 'string', 'max:255'],
  'phone' => ['required', 'string', 'max:12', 'unique:users'],
  'username' => ['nullable', 'string', 'max:255', 'unique:users'],
  'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
  'password' => ['nullable', 'min:6', 'max:20'],
  'dob' => ['nullable', 'string', 'max:255', ],
  // Address details
  'address' => ['nullable', 'string', 'max:255', ],
  'address_2' => ['nullable', 'string', 'max:255', ],
  'postal_code' => ['nullable', 'string', 'max:255', ],
  'city' => ['nullable', 'string', 'max:255', ],
  'state' => ['nullable', 'string', 'max:255', ],
  'country' => ['nullable', 'string', 'max:255', ],
  // Bio
  'gender' => ['nullable', 'string', 'max:255', ],
  'last_blood_donor_date' => ['nullable', 'string', 'max:255', ],
  'smoking' => ['nullable', 'string', 'max:255', ],
  'alcohal' => ['nullable', 'string', 'max:255', ],
  'veg_nonveg' => ['nullable', 'string', 'max:255', ],
  'medial_history' => ['nullable', 'string', 'max:255', ],
  // Token
  'push_notification_token' => ['nullable', 'string', ],
```

### Login
```POST``` ```http://beta.connectingalife.com/api/login```

Request Headers
```php
Accept: application/json
```

Request Body
```php
  'phone' => ['required', 'string', 'max:12', 'unique:users'],
  'fcm_token' => ['nullable', 'string', ],
```

### Send OTP
```POST``` ```http://beta.connectingalife.com/api/send-otp```

Request Headers
```php
Accept: application/json
```

Request Body
```php
  'phone' => ['required', 'string', 'max:12', 'unique:users'],
```

### User details
```GET``` ```http://beta.connectingalife.com/api/me```

Request Headers
```php
Accept: application/json
Authorization: Bearer <jwt-token>
```

### Pincode details
```GET``` ```http://beta.connectingalife.com/api/geo-locations?postal_code=<postal_code>```

Request Headers
```php
Accept: application/json
```

Query params
```php
  'postal_code' => ['required', 'string', 'max:6', ],
```


