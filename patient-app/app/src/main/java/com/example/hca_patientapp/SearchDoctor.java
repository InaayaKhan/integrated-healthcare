package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;

import java.util.ArrayList;
import java.util.List;

public class SearchDoctor extends AppCompatActivity {

    Spinner spnSpecialized;

    EditText etName, etCity;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_doctor);

        getSupportActionBar().setTitle("Search a Doctor");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        spnSpecialized = (Spinner) findViewById(R.id.spnSearchSpecialized);
        List<String> categories = new ArrayList<String>();
        categories.add("Any");
        categories.add("Cardiologist");
        categories.add("Dentist");
        categories.add("Dermatologist");
        categories.add("Naturopath");
        categories.add("Neurologist");
        categories.add("Oncologist");
        categories.add("Pediatrician");
        ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, categories);
        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spnSpecialized.setAdapter(dataAdapter);

        etName = (EditText) findViewById(R.id.txtSearchName);
        etCity = (EditText) findViewById(R.id.txtSearchCity);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void searchDoctor(View v) {
        Intent intent = new Intent(SearchDoctor.this, SearchResult.class);
        Bundle b = new Bundle();
        b.putString("Name","");
        //b.putString("Name",etName.getText().toString().trim());
        b.putString("Specialized",spnSpecialized.getSelectedItem().toString().trim());
        b.putString("City","");
        //b.putString("City",etCity.getText().toString().trim());
        intent.putExtras(b);
        startActivity(intent);
    }
}