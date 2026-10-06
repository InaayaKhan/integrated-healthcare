package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ChangePassword extends AppCompatActivity {
    EditText op;
    EditText np;
    EditText rp;

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_create_account = Common.server_url + "/appchangepassword_patient.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_password);

        getSupportActionBar().setTitle("Change Password");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        op = (EditText)findViewById(R.id.txtOldPassword);
        np = (EditText)findViewById(R.id.txtNewPassword);
        rp = (EditText)findViewById(R.id.txtRetypePassword);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void changePassword(View v) {
        if(op.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter Old Password",Toast.LENGTH_SHORT).show();
            op.requestFocus();
        }
        else if(np.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter New Password",Toast.LENGTH_SHORT).show();
            np.requestFocus();
        }
        else if(rp.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Retype New Password",Toast.LENGTH_SHORT).show();
            rp.requestFocus();
        }
        else if(op.getText().toString().trim().equals(np.getText().toString().trim())) {
            Toast.makeText(this,"Old and New Password cannot be same",Toast.LENGTH_SHORT).show();
            np.requestFocus();
        }
        else if(np.getText().toString().trim().equals(rp.getText().toString().trim()) == false) {
            Toast.makeText(this,"Password Mismatch. Try again",Toast.LENGTH_SHORT).show();
            rp.requestFocus();
        }
        else {
            new CP().execute();
        }
    }

    class CP extends AsyncTask<String, String, String> {

        /**
         * Before starting background thread Show Progress Dialog
         * */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(ChangePassword.this);
            pDialog.setMessage("Updating Password.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        /**
         * Creating product
         * */
        protected String doInBackground(String... args) {

            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("OldPassword", op.getText().toString().trim()));
            params.add(new BasicNameValuePair("NewPassword", np.getText().toString().trim()));
            params.add(new BasicNameValuePair("ID", Common.username));

            // getting JSON Object
            // Note that create product url accepts POST method
            JSONObject json = jsonParser.makeHttpRequest(url_create_account, "POST", params);

            // check log cat fro response
            Log.d("Create Response", json.toString());

            // check for success tag
            try {
                int success = json.getInt(TAG_SUCCESS);
                final String message = json.getString("message");
                if (success == 1) {
                    // successfully created product
                    //Toast.makeText(getApplicationContext(),"Account Created Successfully", Toast.LENGTH_SHORT).show();
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();

                        }
                    });
                    Intent i = new Intent(getApplicationContext(), Login.class);
                    startActivity(i);
                    finish();
                } else {
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(),message, Toast.LENGTH_LONG).show();
                        }
                    });
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;
        }

        /**
         * After completing background task Dismiss the progress dialog
         * **/
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
        }

    }
}
