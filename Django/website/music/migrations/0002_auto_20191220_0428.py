# Generated by Django 2.2.7 on 2019-12-20 04:28

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('music', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='album',
            name='album_title',
            field=models.CharField(max_length=50),
        ),
    ]
