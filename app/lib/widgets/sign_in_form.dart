import 'package:app/models/user.dart';
import 'package:app/services/authentication.dart';
import 'package:app/widgets/custom_form_field.dart';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';

class SignInForm extends StatefulWidget {
  @override
  SignInFormState createState() {
    return SignInFormState();
  }
}

class SignInFormState extends State<SignInForm> {
  @override
  void initState() {
    super.initState();
  }

  // Create a global key that uniquely identifies the Form widget
  // and allows validation of the form.
  //
  // Note: This is a GlobalKey<FormState>,
  // not a GlobalKey<SignInFormState>.
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _usernameOrEmailController =
      TextEditingController();
  bool _isUsernameOrEmailTouched = false;
  bool _isUsernameOrEmailValid = false;
  String _usernameOrEmailErrorMsg;
  final TextEditingController _passwordController = TextEditingController();
  bool _isPasswordTouched = false;
  bool _isPasswordValid = false;
  String _passwordErrorMsg;
  bool _obscureText = true;
  bool _isProcessing = false;

  _togglePasswordVisibility() {
    setState(() {
      _obscureText = !_obscureText;
    });
  }

  _setUsernameOrEmailTouched() {
    if (!_isUsernameOrEmailTouched) {
      setState(() {
        _isUsernameOrEmailTouched = true;
      });
    }
  }

  _setPasswordTouched() {
    if (!_isPasswordTouched) {
      setState(() {
        _isPasswordTouched = true;
      });
    }
  }

  String _validateUsernameOrEmail(String usernameInput) {
    if (usernameInput.trim().isEmpty) {
      String errorMsg = 'Username or email is required';
      setState(() {
        _isUsernameOrEmailValid = false;
        _usernameOrEmailErrorMsg = errorMsg;
      });
      return errorMsg;
    }
    if (usernameInput.length > 512) {
      String errorMsg =
          'Username or email should contain at most 512 characters';
      setState(() {
        _isUsernameOrEmailValid = false;
        _passwordErrorMsg = errorMsg;
      });
      return errorMsg;
    }
    setState(() {
      _isUsernameOrEmailValid = true;
      _usernameOrEmailErrorMsg = null;
    });
    return null;
  }

  String _validatePassword(String passwordInput) {
    if (passwordInput.trim().isEmpty) {
      String errorMsg = 'Password is required';
      setState(() {
        _isPasswordValid = false;
        _passwordErrorMsg = errorMsg;
      });
      return errorMsg;
    }
    if (passwordInput.trim().length < 6) {
      String errorMsg = 'Password should contain at least 6 characters';
      setState(() {
        _isPasswordValid = false;
        _passwordErrorMsg = errorMsg;
      });
      return errorMsg;
    }
    if (passwordInput.length > 512) {
      String errorMsg = 'Password should contain at most 512 characters';
      setState(() {
        _isPasswordValid = false;
        _passwordErrorMsg = errorMsg;
      });
      return errorMsg;
    }
    setState(() {
      _isPasswordValid = true;
      _passwordErrorMsg = null;
    });
    return null;
  }

  bool _validateForm() {
    return _formKey.currentState.validate();
  }

  Future<void> _signIn() async {
    String usernameOrEmailInput = _usernameOrEmailController.text;
    String passwordInput = _passwordController.text;

    var user = UserSignIn(
        usernameOrEmail: usernameOrEmailInput, password: passwordInput);

    try {
      var response = await Authentication.signIn(user: user);
      print('''Status code: ${response.statusCode}
      Body: ${response.body}
      Headers: ${response.headers}
      ''');
    } catch (err) {
      print('Could not process sign in request');
      print(err);
    }
  }

  @override
  Widget build(BuildContext context) {
    // Build a Form widget using the _formKey created above.
    return Form(
      key: _formKey,
      child: Column(
        children: [
          CustomFormField(
            label: 'Username or email *',
            errorMsg: _usernameOrEmailErrorMsg,
            isPassword: false,
            isTouched: _isUsernameOrEmailTouched,
            isValid: _isUsernameOrEmailValid,
            setTouched: _setUsernameOrEmailTouched,
            validation: _validateUsernameOrEmail,
            controller: _usernameOrEmailController,
          ),
          const Padding(
            padding: EdgeInsets.symmetric(vertical: 20.0),
          ),
          CustomFormField(
            label: 'Password *',
            errorMsg: _passwordErrorMsg,
            isPassword: true,
            isTouched: _isPasswordTouched,
            isValid: _isPasswordValid,
            setTouched: _setPasswordTouched,
            validation: _validatePassword,
            obscureText: _obscureText,
            toggleFieldVisibility: _togglePasswordVisibility,
            controller: _passwordController,
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 40.0),
            child: MaterialButton(
              disabledColor: Colors.grey[600],
              disabledTextColor: Colors.white,
              onPressed: () async {
                if (_validateForm()) {
                  // send request to authenticate data with Users API
                  Scaffold.of(context)
                      .showSnackBar(SnackBar(content: Text('Processing Data')));
                  await _signIn();
                }
              },
              color: Color.fromARGB(255, 74, 169, 242),
              minWidth: double.infinity,
              child: Text('Sign in'),
            ),
          ),
        ],
      ),
    );
  }
}
