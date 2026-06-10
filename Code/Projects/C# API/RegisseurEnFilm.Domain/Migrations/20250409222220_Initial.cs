using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

#pragma warning disable CA1814 // Prefer jagged arrays over multidimensional

namespace RegisseurEnFilm.Domain.Migrations
{
    /// <inheritdoc />
    public partial class Initial : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Regisseurs",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Naam = table.Column<string>(type: "TEXT", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Regisseurs", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Films",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Titel = table.Column<string>(type: "TEXT", nullable: false),
                    Publicatiedatum = table.Column<DateTime>(type: "TEXT", nullable: false),
                    RegisseurID = table.Column<int>(type: "INTEGER", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Films", x => x.Id);
                    table.ForeignKey(
                        name: "FK_Films_Regisseurs_RegisseurID",
                        column: x => x.RegisseurID,
                        principalTable: "Regisseurs",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.InsertData(
                table: "Regisseurs",
                columns: new[] { "Id", "Naam" },
                values: new object[,]
                {
                    { 1, "Jan Henken" },
                    { 2, "Simon Jansen" }
                });

            migrationBuilder.InsertData(
                table: "Films",
                columns: new[] { "Id", "Publicatiedatum", "RegisseurID", "Titel" },
                values: new object[,]
                {
                    { 1, new DateTime(2025, 4, 5, 0, 0, 0, 0, DateTimeKind.Unspecified), 1, "Horizon De Films" },
                    { 2, new DateTime(2025, 4, 5, 0, 0, 0, 0, DateTimeKind.Unspecified), 2, "Horizon De Films" }
                });

            migrationBuilder.CreateIndex(
                name: "IX_Films_RegisseurID",
                table: "Films",
                column: "RegisseurID");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Films");

            migrationBuilder.DropTable(
                name: "Regisseurs");
        }
    }
}
