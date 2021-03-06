using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Wellcome.Database.Migrations
{
    public partial class Trips : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Address",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Street = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    City = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Country = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    PostalCode = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Latitude = table.Column<double>(type: "float", nullable: false),
                    Longitude = table.Column<double>(type: "float", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Address", x => x.ID);
                });

            migrationBuilder.CreateTable(
                name: "Contact",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    FirstName = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    LastName = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Phone = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Mail = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Contact", x => x.ID);
                });

            migrationBuilder.CreateTable(
                name: "HostConfiguration",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Rooms = table.Column<int>(type: "int", nullable: false),
                    Beds = table.Column<int>(type: "int", nullable: false),
                    Bathrooms = table.Column<int>(type: "int", nullable: false),
                    Equipments = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_HostConfiguration", x => x.ID);
                });

            migrationBuilder.CreateTable(
                name: "TravelersConfiguration",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Adults = table.Column<int>(type: "int", nullable: false),
                    Babies = table.Column<int>(type: "int", nullable: false),
                    Pets = table.Column<int>(type: "int", nullable: false),
                    Childs = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_TravelersConfiguration", x => x.ID);
                });

            migrationBuilder.CreateTable(
                name: "User",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Uuid = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    ContactId = table.Column<int>(type: "int", nullable: false),
                    Profession = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Description = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Age = table.Column<int>(type: "int", nullable: true),
                    Gender = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Languages = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    BirthDate = table.Column<DateTime>(type: "datetime2", nullable: false),
                    Password = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_User", x => x.ID);
                    table.ForeignKey(
                        name: "FK_User_Contact_ContactId",
                        column: x => x.ContactId,
                        principalTable: "Contact",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "Feedback",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Notation = table.Column<int>(type: "int", nullable: false),
                    TimeStamp = table.Column<DateTime>(type: "datetime2", nullable: false),
                    UserId = table.Column<int>(type: "int", nullable: false),
                    Remark = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Feedback", x => x.ID);
                    table.ForeignKey(
                        name: "FK_Feedback_User_UserId",
                        column: x => x.UserId,
                        principalTable: "User",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "Host",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Uuid = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Title = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Description = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    AddressID = table.Column<int>(type: "int", nullable: false),
                    UserId = table.Column<int>(type: "int", nullable: false),
                    HostConfigurationID = table.Column<int>(type: "int", nullable: false),
                    TravelersConfigurationID = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Host", x => x.ID);
                    table.ForeignKey(
                        name: "FK_Host_Address_AddressID",
                        column: x => x.AddressID,
                        principalTable: "Address",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Host_HostConfiguration_HostConfigurationID",
                        column: x => x.HostConfigurationID,
                        principalTable: "HostConfiguration",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Host_TravelersConfiguration_TravelersConfigurationID",
                        column: x => x.TravelersConfigurationID,
                        principalTable: "TravelersConfiguration",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Host_User_UserId",
                        column: x => x.UserId,
                        principalTable: "User",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "ProfilePicture",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Path = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    UserId = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_ProfilePicture", x => x.ID);
                    table.ForeignKey(
                        name: "FK_ProfilePicture_User_UserId",
                        column: x => x.UserId,
                        principalTable: "User",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "FavoriteHosts",
                columns: table => new
                {
                    UserId = table.Column<int>(type: "int", nullable: false),
                    HostId = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_FavoriteHosts", x => new { x.UserId, x.HostId });
                    table.ForeignKey(
                        name: "FK_FavoriteHosts_Host_HostId",
                        column: x => x.HostId,
                        principalTable: "Host",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Restrict);
                    table.ForeignKey(
                        name: "FK_FavoriteHosts_User_UserId",
                        column: x => x.UserId,
                        principalTable: "User",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Restrict);
                });

            migrationBuilder.CreateTable(
                name: "HostPicture",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Path = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    HostId = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_HostPicture", x => x.ID);
                    table.ForeignKey(
                        name: "FK_HostPicture_Host_HostId",
                        column: x => x.HostId,
                        principalTable: "Host",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "HostReservation",
                columns: table => new
                {
                    UserId = table.Column<int>(type: "int", nullable: false),
                    HostId = table.Column<int>(type: "int", nullable: false),
                    Phone = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Message = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Uuid = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    StartDate = table.Column<DateTime>(type: "datetime2", nullable: false),
                    EndDate = table.Column<DateTime>(type: "datetime2", nullable: false),
                    Status = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_HostReservation", x => new { x.UserId, x.HostId });
                    table.ForeignKey(
                        name: "FK_HostReservation_Host_HostId",
                        column: x => x.HostId,
                        principalTable: "Host",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_HostReservation_User_UserId",
                        column: x => x.UserId,
                        principalTable: "User",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Restrict);
                });

            migrationBuilder.InsertData(
                table: "Address",
                columns: new[] { "ID", "City", "Country", "Latitude", "Longitude", "PostalCode", "Street" },
                values: new object[] { 1, "Soisy", "France", 48.988506000000001, 2.299731, "95230", "11 rue des dures terres" });

            migrationBuilder.InsertData(
                table: "Contact",
                columns: new[] { "ID", "FirstName", "LastName", "Mail", "Phone" },
                values: new object[,]
                {
                    { 1, "Rayhane", "JEBBARI", "jebray@gmail.com", "0668319888" },
                    { 2, "Jialei", "SUN", "sunjia@gmail.com", "0668315554" }
                });

            migrationBuilder.InsertData(
                table: "HostConfiguration",
                columns: new[] { "ID", "Bathrooms", "Beds", "Equipments", "Rooms" },
                values: new object[] { 1, 1, 2, "Machine", 3 });

            migrationBuilder.InsertData(
                table: "TravelersConfiguration",
                columns: new[] { "ID", "Adults", "Babies", "Childs", "Pets" },
                values: new object[] { 1, 2, 2, 0, 0 });

            migrationBuilder.InsertData(
                table: "User",
                columns: new[] { "ID", "Age", "BirthDate", "ContactId", "Description", "Gender", "Languages", "Password", "Profession", "Uuid" },
                values: new object[] { 1, 31, new DateTime(2022, 3, 12, 21, 46, 13, 59, DateTimeKind.Utc).AddTicks(1930), 1, "I like meet new people !", "Male", "French", "password", "It Engineer", "7dd7dff5-077f-4c8a-b442-53755a0233e8" });

            migrationBuilder.InsertData(
                table: "User",
                columns: new[] { "ID", "Age", "BirthDate", "ContactId", "Description", "Gender", "Languages", "Password", "Profession", "Uuid" },
                values: new object[] { 2, 31, new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified), 2, "I like meet new people !", "Male", "French", "password", "It Engineer", "464562f8-1fd5-476d-88a9-0fc4ca394de5" });

            migrationBuilder.InsertData(
                table: "Feedback",
                columns: new[] { "ID", "Notation", "Remark", "TimeStamp", "UserId" },
                values: new object[] { 1, 4, "Good host !", new DateTime(2022, 3, 12, 22, 46, 13, 59, DateTimeKind.Local).AddTicks(2025), 1 });

            migrationBuilder.InsertData(
                table: "Host",
                columns: new[] { "ID", "AddressID", "Description", "HostConfigurationID", "Title", "TravelersConfigurationID", "UserId", "Uuid" },
                values: new object[] { 1, 1, "Description", 1, "Title", 1, 1, "fb916065-a77b-4ebb-8027-a771bd4914e3" });

            migrationBuilder.InsertData(
                table: "ProfilePicture",
                columns: new[] { "ID", "Path", "UserId" },
                values: new object[] { 1, "/Images/Seth_Luty_Profile_Picture.jpg", 1 });

            migrationBuilder.InsertData(
                table: "FavoriteHosts",
                columns: new[] { "HostId", "UserId" },
                values: new object[] { 1, 1 });

            migrationBuilder.InsertData(
                table: "HostPicture",
                columns: new[] { "ID", "HostId", "Path" },
                values: new object[] { 1, 1, "/Images/corporate_housing_newyork1.jpg" });

            migrationBuilder.InsertData(
                table: "HostReservation",
                columns: new[] { "HostId", "UserId", "EndDate", "Message", "Phone", "StartDate", "Status", "Uuid" },
                values: new object[] { 1, 2, new DateTime(1999, 9, 3, 0, 0, 0, 0, DateTimeKind.Unspecified), "Hello, I want to stay !", "0668319800", new DateTime(1999, 9, 2, 0, 0, 0, 0, DateTimeKind.Unspecified), "Waiting", "37b8367d-a817-475a-a1b0-ea9ad1b70e7d" });

            migrationBuilder.CreateIndex(
                name: "IX_FavoriteHosts_HostId",
                table: "FavoriteHosts",
                column: "HostId");

            migrationBuilder.CreateIndex(
                name: "IX_Feedback_UserId",
                table: "Feedback",
                column: "UserId");

            migrationBuilder.CreateIndex(
                name: "IX_Host_AddressID",
                table: "Host",
                column: "AddressID");

            migrationBuilder.CreateIndex(
                name: "IX_Host_HostConfigurationID",
                table: "Host",
                column: "HostConfigurationID");

            migrationBuilder.CreateIndex(
                name: "IX_Host_TravelersConfigurationID",
                table: "Host",
                column: "TravelersConfigurationID");

            migrationBuilder.CreateIndex(
                name: "IX_Host_UserId",
                table: "Host",
                column: "UserId");

            migrationBuilder.CreateIndex(
                name: "IX_HostPicture_HostId",
                table: "HostPicture",
                column: "HostId",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "IX_HostReservation_HostId",
                table: "HostReservation",
                column: "HostId");

            migrationBuilder.CreateIndex(
                name: "IX_ProfilePicture_UserId",
                table: "ProfilePicture",
                column: "UserId",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "IX_User_ContactId",
                table: "User",
                column: "ContactId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "FavoriteHosts");

            migrationBuilder.DropTable(
                name: "Feedback");

            migrationBuilder.DropTable(
                name: "HostPicture");

            migrationBuilder.DropTable(
                name: "HostReservation");

            migrationBuilder.DropTable(
                name: "ProfilePicture");

            migrationBuilder.DropTable(
                name: "Host");

            migrationBuilder.DropTable(
                name: "Address");

            migrationBuilder.DropTable(
                name: "HostConfiguration");

            migrationBuilder.DropTable(
                name: "TravelersConfiguration");

            migrationBuilder.DropTable(
                name: "User");

            migrationBuilder.DropTable(
                name: "Contact");
        }
    }
}
