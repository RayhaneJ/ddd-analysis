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
                    ContactId = table.Column<int>(type: "int", nullable: false),
                    Profession = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Description = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Age = table.Column<int>(type: "int", nullable: false),
                    Gender = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Language = table.Column<string>(type: "nvarchar(max)", nullable: false),
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
                columns: new[] { "ID", "Age", "ContactId", "Description", "Gender", "Language", "Password", "Profession" },
                values: new object[] { 1, 31, 1, "I like meet new people !", "Male", "French", "password", "It Engineer" });

            migrationBuilder.InsertData(
                table: "Feedback",
                columns: new[] { "ID", "Notation", "Remark", "TimeStamp", "UserId" },
                values: new object[] { 1, 4, "Good host !", new DateTime(2021, 12, 29, 23, 47, 49, 376, DateTimeKind.Local).AddTicks(329), 1 });

            migrationBuilder.InsertData(
                table: "Host",
                columns: new[] { "ID", "AddressID", "Description", "HostConfigurationID", "Title", "TravelersConfigurationID", "UserId" },
                values: new object[] { 1, 1, "Description", 1, "Title", 1, 1 });

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
